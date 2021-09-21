<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Zone;
use App\Models\Country;
use App\Models\State;
use App\Models\Region;
use App\Models\City;
use App\Models\Warehouse;
use DB;
use Yajra\DataTables\DataTables;
class ZoneController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Zone::
            join('regions','regions.id','zones.region_id')
            ->join('states','states.id','regions.region_id')
           ->select('zones.*','states.name as state_name')->get();
           
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function(Zone $data){
                    if($data->status == 1){
                        $status = '<span class="badge badge-success">Active</span>';
                    }
                    else{
                        $status = '<span class="badge badge-danger">Inactivate</span>';
                    }
                    return $status;
                })
                ->addColumn('view',function($data){
                    $sheduleZone = '<a href="javascript:void(0);" class="btn btn-sm btn-primary view_schedule" data-id="'.$data->id.'" style ="margin-top:5px;">View</a>';  
                    return $sheduleZone;
                })
                ->addColumn('action', function(Zone $data){
                    $btn1 = '<a data-id="'.$data->id.'" data-tab="zones" data-url="zone/delete" 
                    href="javascript:void(0)" class="del_btn btn btn-sm btn-danger">Delete</a>';
                    $btn2 = '<button data-id="'.$data->id.'" class="btn btn-sm btn-primary zone_edit" >Edit</button>';
                     //$btn3 = '<a href="'.route('distributor.detail', $data->id).'" class="btn btn-primary btn-sm"> Detail </a>';
                    if($data->status == 1){
                        $status = '<a onclick="changeZoneStatus('.$data->id.',0)" href="javascript:void(0)" class="btn btn-sm btn-danger" style ="margin-top:5px;">Inactivate</a>';
                    }
                    else{
                        $status = '<a onclick="changeZoneStatus('.$data->id.',1)" href="javascript:void(0)" class="btn btn-sm btn-success" style ="margin-top:5px;">Activate</a>';
                    }

                    return $btn2.'  '.$status.' '.$btn1;
                })
                ->rawColumns(['action','status','view'])
                ->make(true);
        }
        $countries = Country::where('status', '1')->get();
        $warehouses= Warehouse::all();
        $regions = Region::
        join('states','states.id','regions.region_id')
        ->select('regions.id','states.name as name')->get();

        return view('admin.warehouse.index',compact('countries','regions','warehouses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */

    public function store(Request $request)
    {
        $data = Zone::create($request->except('_token'));
        return redirect()->route('zone.index')->with('success', 'Record added successfully.');
    }

    public function destroy($id)
    {
        $product = Zone::findOrFail($id);
        $product->delete();
        return response()->json(array(
            'data' => true,
            'message' => 'Zone Successfully Deleted',
            'status' => 'success',
        ));
    }

    public function zonestatus(Request $request)
    {
        $distributor = Zone::findOrFail($request->id);
        if (empty($distributor)) {
            return redirect()->back()->with('error', 'No Record Found.');
        }
        $distributor->update(['status'=> $request->input('status')]);
        $status = $distributor->status;
        return response()->json(['status'=>$status,'message'=>'Status Changed Successfully']);
    }

    public function getZone(Request $request)
    {
        $request->validate([
            'id'=> 'required'
        ]);
        $zone=Zone::findOrFail($request->id);
        $countries = Country::where('status', '1')->get();
        $states = State::where('status', '1')->get();
        $regions = Region::
        join('states','states.id','regions.region_id')
        ->select('regions.id','states.name as name')->get();
        return response()->json([
            'html' => view('admin.warehouse.zone_edit', compact('zone','states','regions','countries'))->render()
            ,200, ['Content-Type' => 'application/json']
        ]);
    }

    public function update(Request $request, $id)
    {
        $product = Zone::find($id)->update($request->except('_token'));
        return redirect()->route('warehouse.index')->with('success', 'Record updated successfully.');
    }

    public function sheduleZone(Request $request)
    {
        $shedule=DB::table('delivery_schedule_zones')->where('zone_id',$request->id)->get(); 
        $id= $shedule->pluck('id');
        $days=$shedule->pluck('day_id','day_id');
        $zone=$request->id;

        return response()->json([
            'html' => view('admin.warehouse.shedule', compact('zone','id','days'))->render()
            ,200, ['Content-Type' => 'application/json']
        ]);
    }

    public function sheduleChange(Request $request)
    {
        $shedule=DB::table('delivery_schedule_zones')->where(['zone_id'=>$request->zone_id,'day_id'=>$request->day_id])->first();
      
        if(!empty($shedule))
        {
            DB::table('delivery_schedule_zones')->delete($shedule->id);
        }
        else
        {
            $shedule=DB::table('delivery_schedule_zones')->insert(['day_id'=>$request->day_id,'status'=>1,'zone_id'=>$request->zone_id]); 
        }
       
      
        return response()->json(array(
            'data' => $request->id,
            'message' => 'Zone Sheduled updated Successfully',
            'status' => 'success',
        ));
    }
}
