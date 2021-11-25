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
use App\Models\User;
use App\Models\AssignGroup;
use App\Models\CasualOrder;
use App\Models\Service;
use Carbon\Carbon;
use App\Mail\CasualMail;
use Auth;
use Mail;
use DB;

use Illuminate\Http\Request;

class NotificationController extends Controller
{

    public function getProducts(Request $request)
    {
        $date=Carbon::now();
        $today=$date->dayOfWeek;
        $userId=$request->id;
         $customer=User::whereId($userId)->first();
        $products1=AssignGroup::join('users','users.id','assign_groups.user_id')
        ->where('assign_groups.user_id',$userId)
        ->select('assign_groups.assign_group_id as groupId')
        ->get()->map(function($value){
            $p=Service::where('services.group_id',$value->groupId)->whereSaleable(1)
                ->join('products','products.id','services.product_id')
                ->select('products.id as id','products.name as name','products.price as price'
                ,'products.image_url as image_url','products.pack_size as pack_size')
                ->get();
            return $p;
        });
         $v=$products1->flatten();
             $value=$v->sortBy('ctnPrice');
 
             $products = array();
             $ark = array(); 
                     foreach ($value as  $value1) {
                        
                         if(!in_array($value1['id'],$ark))
                         {
                             array_push($ark,$value1['id']);
                             $products[] =$value1; 
                         }
                     }
                     $customerDetail = CustomerDetail::where('user_id',$userId)->first();
                     $deliveryRegion = $customerDetail->delivery_region ?? '';
             
                     $ZoneID = Zone::where('name',$customerDetail->delivery_zone ?? '')->first();
                     $deliveryZoneDay =  DB::table('delivery_schedule_zones')->where('zone_id',$ZoneID->id ?? '')->where('status',1)->pluck('day_id','day_id');
                     //this Weekend 
                     $weekDays = WeekDay::with(['WeekDay' => function($q) use ($userId,$deliveryRegion){
                         $q->userDetail($userId,$deliveryRegion);
                     }])->get();
                     return response()->json([
                        'html' => view('admin.driver.getproducts',compact('products','deliveryRegion','customer','today','weekDays','deliveryZoneDay'))->render(), 200, ['Content-Type' => 'application/json']
                    ]);
    }
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

    public function picklistDetail($id)
    {
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

    public function casualOrder()
    {

        $customers = User::role('Customer')->join('customer_details','customer_details.user_id','users.id')
         ->select('customer_details.delivery_name as delivery_name','users.id as id')->get();
       return view('admin.driver.casual-orders',compact('customers'));
    }
  
    public function deliveredProducts(Request $request)
    {
        $products=$request->productIds;
       if(!isset($products))
        return redirect()->back()->with(['error' => 'First select Customer and enter quantity']);
        foreach ($products as $key => $value) {  
            $customerId= $request->customer;
            $data = [
                'product_id' => $value,
                'quantity' => $request->quantity[$key],
                'driver_id' => auth()->user()->id,
                'customer_id' => $customerId,
                ];
            CasualOrder::create($data);
        }
        $customerReceivingId=  CasualOrder::whereCustomerId($customerId)->first();
        session()->put('customerReceivingId',$customerId);
        // $customerEmail= User::whereId($customer1->customer_id)->first()->email;
        // Mail::to($customerEmail)->send(new CasualMail($customer));
        $customer= $request->customer;
        return view('admin.driver.confirmation',compact('customer'));
    }
      public function printDeliveryDocket($id)
      {
        $time=CasualOrder::orderBy('created_at','desc')->latest()->first()->created_at;
        $customerId=decrypt($id);
        $customer= CustomerDetail::whereUserId($customerId)->first();
        $products= CasualOrder::join('products','products.id','casual_orders.product_id')
                      ->where(['casual_orders.customer_id'=> $customerId])
                     ->whereBetween('casual_orders.created_at', [$time, now()])
                     ->select('products.name as name',DB::raw('SUM(casual_orders.quantity) as quantity'))
                     ->groupBy('name')
                     ->get();
                     $receiverId=session()->get('customerReceivingId');
        return view('admin.driver.delivery_docket',compact('customer','products','receiverId'));
      }
}
