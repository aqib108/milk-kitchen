<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warehouse;
use App\Http\Requests\WarehouseRequest;
use Yajra\DataTables\DataTables;
use App\Models\User;
use App\Models\Region;
class WareHouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {         
            //  Zone::join('region','region.id','zones.region_id')
            //         ->leftjoin('customer_details','customer_details.delivery_region','zones.region_id')
            //         ->get();
            //   $detail=CustomerDetail::join('users','users.id','customer_details.user_id')
            //                          ->join('regions','regions.region','customer_details.delivery_region')
            //                          ->select('users.name as name','customer_details.user_id as CustomerID',
            //                          'customer_details.business_address_1 as address','regions.id as regionID',)
            //                         ->get()
            //                         ->map(function($region){
            //                             $p= ProductOrder::
            //                             leftjoin('products','products.id','product_orders.product_id')
            //                             ->where('product_orders.user_id',$region->CustomerID)
            //                             ->select('products.name as name','product_orders.quantity as corton')
            //                             ->get();
            //                               $zone=Zone::whereRegionId($region->regionID)->get('name');
            //                           return $p.$zone;
                                    // $var= Region::where('regions.region',$region->delivery_region)
                                    // ->join('warehouses','warehouses.id','regions.warehouse_id')
                                    // ->select('warehouses.name')
                                    // ->get();
                                    // return $var;
                    //             });
                    // dd($detail);
                    //  $warehouseId= Warehouse::where('id',2)->first()->id;
                    //     $product= Region::leftjoin('customer_details','customer_details.delivery_region','regions.region')
                    //              ->where('regions.warehouse_id',$warehouseId)
                    //              ->select('customer_details.user_id')
                    //              ->get()->map(function($value){
                    //                 $p= ProductOrder::leftjoin('products','products.id','product_orders.product_id')
                    //                  ->where('product_orders.user_id',$value->user_id)
                    //                  ->select('products.name as name','product_orders.quantity as corton')
                    //                   ->get();
                    //                   return $p;
                    //                 });
                    //                 $products=$product->first();
                    //                 return view('admin.customer.master_picklist',compact('products'));
                                
              $data = User::role('Customer')->get(); 
        //   dd($data);
        if ($request->ajax()) {
            $data = Warehouse::orderBy('id','DESC')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function(Warehouse $data){
                    if($data->status == 1){
                        $status = '<span class="badge badge-success">Active</span>';
                    }
                    else{
                        $status = '<span class="badge badge-danger">Inactivate</span>';
                    }
                    return $status;
                })
                ->addColumn('action', function(Warehouse $data){
                    $btn1 = '<a data-id="'.$data->id.'" data-tab="warehouse" data-url="warehouse/delete" 
                    href="javascript:void(0)" class="del_btn btn btn-sm btn-danger">Delete</a>';
                    $btn2 = '<button data-id="'.$data->id.'" class="btn btn-sm btn-primary edit" >Edit</button>';
                    if($data->status == 1){
                        $status = '<a onclick="changeStatus('.$data->id.',0)" href="javascript:void(0)" class="btn btn-sm btn-danger" style ="margin-top:5px;">Inactivate</a>';
                    }
                    else{
                        $status = '<a onclick="changeStatus('.$data->id.',1)" href="javascript:void(0)" class="btn btn-sm btn-success" style ="margin-top:5px;">Activate</a>';
                    }

                    return $btn2.'  '.$status.' '.$btn1;
                })
                ->rawColumns(['action','status'])
                ->make(true);
        }
        $regions = Region::orderBy('id', 'DESC')->get();
        $warehouses= Warehouse::where('status',1)->get();
        return view('admin.warehouse.index',compact('regions','warehouses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WarehouseRequest $request)
    {
        $data = Warehouse::updateOrCreate(['name'=>$request->warehouse_name]);
        return redirect()->route('warehouse.index')->with('success', 'Record added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Warehouse::find($id)->update(['name' => $request->warehouse_name]);
        return redirect()->route('warehouse.index')->with('success', 'Record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Warehouse::findOrFail($id);
        $product->delete();
        return response()->json(array(
            'data' => true,
            'message' => 'Distributor Successfully Deleted',
            'status' => 'success',
        ));
    }
    public function status(Request $request)
    {
        $warehouse = Warehouse::findOrFail($request->id);
        if (empty($warehouse)) {
            return redirect()->back()->with('error', 'No Record Found.');
        }
        $warehouse->update(['status'=> $request->input('status')]);
        $status = $warehouse->status;
        return response()->json(['status'=>$status,'message'=>'Status Changed Successfully']);
    }


    public function getWarehouse(Request $request)
    {
        $request->validate([
            'id'=> 'required'
        ]);
        $warehouse = Warehouse::findOrFail($request->id);
        return response()->json([
            'html' => view('admin.warehouse.edit', compact('warehouse'))->render()
            ,200, ['Content-Type' => 'application/json']
        ]);

    }
}
