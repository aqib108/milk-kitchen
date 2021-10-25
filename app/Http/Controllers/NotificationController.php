<?php

namespace App\Http\Controllers;
use App\Models\DriverNotification;
use Yajra\DataTables\DataTables;
use App\Models\CustomerDetail;
use App\Models\AssignDriverOrder;
use App\Models\ProductOrder;
use App\Models\WeekDay;
use App\Models\Region;
use App\Models\Zone;
use Carbon\Carbon;
use Auth;
use DB;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function checkDriverNotification(Request $request)
    {
        $driver =  Auth::user()->id;
        $notifications = DriverNotification::where('driver_id',$driver)->get();
        foreach($notifications as $notification){
            $data[] = [
                'driverMessage' => $notification->message,
                'url' => url(route('driverPicklist.index',$notification->id))
            ];
        }

        return response()->json(['notifications' => $data]);
    }

    /// Driver picklist
    public function driverPicklistIndex(Request $request,$id = null)
    {
        if($id != null){
            $notify = DriverNotification::find($id);
            $notify->delete();
        }
        $driver =  Auth::user()->id;
        if ($request->ajax()) {
            $datas = AssignDriverOrder::where('driver_id',$driver)->where('is_assign',1)->get(); 
            $data1 = array();
            foreach($datas as $data){
                $dataa = CustomerDetail::where('user_id',$data->customer_id)->get();
                array_push($data1,$dataa);
            }
            return Datatables::of($data1)
                ->addIndexColumn()
                ->addColumn('name', function($data1) {
                    foreach($data1 as $dat){
                        $name= $dat->user->name;
                        return $name; 
                    } 
                })
                ->addColumn('address', function($data1) {
                    foreach($data1 as $dat){
                        $address= $dat->delivery_address_1;
                        return $address; 
                    } 
                })
                ->addColumn('action', function($data1){
                    foreach($data1 as $dat){
                        $btn1 = '<a href="'.route('picklist.detail', $dat->user_id).'" class="btn btn-primary btn-sm"> Detail </a>';
                        return $btn1;
                    }
                    
                })
            ->rawColumns(['name','address','action'])
            ->make(true);    
        }
        return view('admin.driver.runpicklist'); 
    }

    public function picklistDetail($id){
        $customerDetail = CustomerDetail::where('user_id',$id)->first();
        if($customerDetail != null)
        {
            $date = Carbon::now();
            $current_day = Carbon::Today()->format('l');
            $dayID = WeekDay::where('name', $current_day)->pluck('id');
            $warehouse = Region::where('name',$customerDetail->delivery_region)->first();
            $zone = Zone::where('region_id',$warehouse->id)->first();
            $productOrder = ProductOrder::leftjoin('products', 'products.id', 'product_orders.product_id')
                ->where(['product_orders.user_id' => $customerDetail->user_id, 'product_orders.day_id' => $dayID])
                ->select('products.name as name', DB::raw('SUM(product_orders.quantity) as carton'))
                ->groupBy('name')
                ->get();

            return view('admin.driver.picklist-detail',compact('warehouse','zone','date','current_day','productOrder'));
        }
       
    }
}
