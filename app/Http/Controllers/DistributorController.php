<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Distributor;
use App\Models\Warehouse;
use App\Http\Requests\DistributorRequest;
use App\Http\Requests\WarehouseRequest;
use Yajra\DataTables\DataTables;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Region;
use Validator;
class DistributorController extends Controller
{

    public function checkEmail(Request $request)
    {
        $input = $request->only(['email']);

        $request_data = [
            'email' => 'required|email|unique:distributors,ends_with:.com',
        ];

        $validator = Validator::make($input, $request_data);

        // json is null
        if ($validator->fails()) {
            $errors = json_decode(json_encode($validator->errors()), 1);
            return response()->json([
                'success' => false,
                'message' => array_reduce($errors, 'array_merge', array()),
            ]);
        } else {
            return response()->json([
                'success' => true,
                'message' => "<span style='color:#95d60c;'>The email is available"
            ]);
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $data = Warehouse::orderBy('id','DESC')->get();
        if ($request->ajax()) {
            $data = Warehouse::orderBy('id','DESC')->get();
            // dd($data);
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
                    $btn1 = '<a data-id="'.$data->id.'" data-tab="distributors" data-url="distributor/delete" 
                    href="javascript:void(0)" class="del_btn btn btn-sm btn-danger">Delete</a>';
                    $btn2 = '<button data-id="'.$data->id.'" class="btn btn-sm btn-primary edit" >Edit</button>';
                     //$btn3 = '<a href="'.route('distributor.detail', $data->id).'" class="btn btn-primary btn-sm"> Detail </a>';
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
        $countries = Country::where('status', '1')->get();
          $warehouses= Warehouse::all();
          $regions = Region::
          join('states','states.id','regions.region_id')
          ->select('regions.id','states.name as name')->get();
          // dd($data);
        return view('admin.distributor.index',compact('countries','regions','warehouses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::where('status', '1')->get();
        return view('admin.distributor.create',compact('countries'));
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
        return redirect()->route('distributor.index');
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
        $distributor = Distributor::findOrFail($id);
        if ($distributor == null) {
            return redirect()->back()->with('error', 'No Record Found.');
        }
        $countries = Country::where('status','1')->orderby('name','ASC')->get();
        $states = State::where('status','1')->orderby('name','ASC')->get();
        $cities = City::where('status','1')->orderby('name','ASC')->get();
      
        return view('admin.distributor.edit',compact('distributor','countries','states','cities'));
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
        return redirect()->route('distributor.index')->with('success', 'Record updated successfully.');
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
        $distributor = Warehouse::findOrFail($request->id);
        if (empty($distributor)) {
            return redirect()->back()->with('error', 'No Record Found.');
        }
        $distributor->update(['status'=> $request->input('status')]);
        $status = $distributor->status;
        return response()->json(['status'=>$status,'message'=>'Status Changed Successfully']);
    }


    public function getWarehouse(Request $request)
    {
        $request->validate([
            'id'=> 'required'
        ]);
        $warehouse = Warehouse::findOrFail($request->id);
        return response()->json([
            'html' => view('admin.distributor.edit', compact('warehouse'))->render()
            ,200, ['Content-Type' => 'application/json']
        ]);

    }
}
