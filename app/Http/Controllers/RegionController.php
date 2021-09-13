<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegionRequest;
use App\Models\Region;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Warehouse;
use Yajra\DataTables\DataTables;

class RegionController extends Controller
{
    //
    public function __constructor()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        // $data = Warehouse::orderBy('id','DESC')->get();
        if ($request->ajax()) {
            $data = Region::
            join('states','states.id','regions.region_id')
            ->join('warehouses','warehouses.id','regions.warehouse_id')
            ->select('regions.*','warehouses.name as warehouse_name','states.name as state_name')->get();
            // dd($data);
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function(Region $data){
                    if($data->status == 1){
                        $status = '<span class="badge badge-success">Active</span>';
                    }
                    else{
                        $status = '<span class="badge badge-danger">Inactivate</span>';
                    }
                    return $status;
                })
                ->addColumn('action', function(Region $data){
                    $btn1 = '<a data-id="'.$data->id.'" data-tab="regions" data-url="region/delete" 
                    href="javascript:void(0)" class="del_btn btn btn-sm btn-danger">Delete</a>';
                    $btn2 = '<button data-id="'.$data->id.'" class="btn btn-sm btn-primary region_edit" >Edit</button>';
                     //$btn3 = '<a href="'.route('distributor.detail', $data->id).'" class="btn btn-primary btn-sm"> Detail </a>';
                

                    return $btn2.'  '.$btn1;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $countries = Country::where('status', '1')->get();
        $warehouses= Warehouse::all();
        $regions = Region::
        join('states','states.id','regions.region_id')
        ->select('regions.id','states.name as name')->get();
        return view('admin.distributor.index',compact('countries','regions','warehouses'));
    }

       /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = Region::updateOrCreate($request->except('_token'));
        return redirect()->route('region.index');
    }

    public function destroy($id)
    {
        $product = Region::findOrFail($id);
        $product->delete();
        return response()->json(array(
            'data' => true,
            'message' => 'Region Successfully Deleted',
            'status' => 'success',
        ));
    }

    public function getRegion(Request $request)
    {
        $request->validate([
            'id'=> 'required'
        ]);
        $region=Region::findOrFail($request->id);
        $countries = Country::where('status', '1')->get();
        $states = State::where('status', '1')->get();
        $warehouses= Warehouse::all();
        return response()->json([
            'html' => view('admin.distributor.region_edit', compact('region','states','warehouses','countries'))->render()
            ,200, ['Content-Type' => 'application/json']
        ]);

    }

    public function update(Request $request, $id)
    {
        $product = Region::find($id)->update($request->except('_token'));
        return redirect()->route('distributor.index')->with('success', 'Record updated successfully.');
    }
    public function regionstatus(Request $request)
    {
        $distributor = Region::findOrFail($request->id);
        if (empty($distributor)) {
            return redirect()->back()->with('error', 'No Record Found.');
        }
        $distributor->update(['status'=> $request->input('status')]);
        $status = $distributor->status;
        return response()->json(['status'=>$status,'message'=>'Status Changed Successfully']);
    }


}
