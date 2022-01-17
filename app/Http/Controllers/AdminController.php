<?php

namespace App\Http\Controllers;

use App\Models\AllocatePayment;
use App\Models\AssignWarehouse;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Warehouse;
use App\Models\WeekDay;
use App\Models\CustomerDetail;
use App\Models\Zone;
use Validator;
use DB;
use PDF;
use App\Models\ProductOrder;
use App\Models\AssignDriverOrder;
use App\Models\AssignDriver;
use App\Models\DriverNotification;
use App\Models\Region;
use Carbon\Carbon;
use App\Models\Setting;
use Spatie\Permission\Traits\HasRoles;

class AdminController extends Controller
{
    protected $userRepo;
    use HasRoles;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepo)
    {
        $this->middleware('auth');
        $this->userRepo = $userRepo;
    }

    public function index()
    {
        $user = Auth::user();
            $products = Product::all();
        $orders = $products->map(function ($p) {
            $p->productscount = ProductOrder::where('product_id', $p->id)->latest()->get()->groupBy(function ($date) {
                return Carbon::parse($date->updated_at)->startOfWeek()->format('d-m-Y');
            });
            return $p;
        });
            $array1 = array();
            $array2 = array();
            $resultant = array();
            $statementvalue = 0;
            foreach ($orders as $key => $value) {
                $productPrice = $value->price;
                foreach ($value->productscount as $key => $value1) {
                    $statementPrice=0;
                    $date = Carbon::parse($key);
                    $start = $date->startOfWeek()->format('Y-m-d'); // 2016-10-17 00:00:00.000000
                    $end = $date->endOfWeek()->format('Y-m-d');
                    $paymentDate =date('Y-m-d', strtotime($end. ' + 15 days'));
                    
                    $regionName = $value1->first()->region_name;
                    if (!in_array($key, $array1)) {
                        array_push($array1, $key);
                        $statementvalue = $value1->sum('quantity') * $productPrice;
                        $array2 = [
                            'start' => $start,
                            'end'   => $end,
                            'paymentDate' => $paymentDate,
                            'region' => $regionName,
                            'statementPrice' => $statementvalue,
                        ];
                        array_push($resultant, $array2);
                    } else {
                        foreach ($resultant as $key => $value) {
                            if ($value['start'] == $start && $value['end'] == $end) {
                                $resultant[$key]['statementPrice'] = $value['statementPrice'] + $value1->sum('quantity') * $productPrice;
                            }
                        }
                    }
                }
            }
    
        return view('admin.index', compact('user','resultant'));
    }

    public function mangeDashBoard()
    {
        $count = array();
        $count['users'] = User::role('Admin')->where('status', '=', '1')->count();
        $count['distributor'] = User::role('Warehouse')->where('status', '=', '1')->count();
        $count['drivers'] = User::role('Driver')->where('status', '=', '1')->count();
        $count['products'] = Product::where('status', '=', '1')->count();

        return response()->json(['status' => true, 'count' => $count]);
    }
    public function masterPicklist()
    {
        $days =  WeekDay::whereStatus(1)->get();
        if (auth()->user()->hasRole('Warehouse') || auth()->user()->hasRole('Site Employee') || auth()->user()->hasRole('Sales Member')) {
            $warehouses = Warehouse::join('assign_warehouses', 'assign_warehouses.warehouse_id', 'warehouses.id')
                ->where('assign_warehouses.user_id', auth()->user()->id)
                ->select('warehouses.*')->whereStatus(1)->get();
        } else 
        {
            $warehouses = Warehouse::whereStatus(1)->get();
        }
        return view('admin.customer.masterPicklist', compact('warehouses', 'days'));
    }

    public function runPicklist()
    {
        $days =  WeekDay::where('status', 1)->get();
        if (auth()->user()->name != 'admin') {
            $warehouses = Warehouse::join('assign_warehouses', 'assign_warehouses.warehouse_id', 'warehouses.id')
                ->where('assign_warehouses.user_id', auth()->user()->id)
                ->select('warehouses.*')->whereStatus(1)->get();
        } else {
            $warehouses = Warehouse::whereStatus(1)->get();
        }
        return view('admin.customer.runPicklist', compact('warehouses', 'days'));
    }

    public function getmasterPicklist()
    {
        if (isset(request()->id))
            $warehouse = Warehouse::whereId(request()->id)->first();
        else
            $warehouse = Warehouse::first();

        $product = Region::leftjoin('customer_details', 'customer_details.delivery_region', 'regions.name')
            ->where('regions.warehouse_id', $warehouse->id)
            ->select('customer_details.user_id')
            ->get()->map(function ($value) {

                if (!empty(request()->day_id)) {
                    $p = ProductOrder::leftjoin('products', 'products.id', 'product_orders.product_id')
                        ->where(['product_orders.user_id' => $value->user_id, 'product_orders.day_id' => request()->day_id])
                        ->select('products.name as name', DB::raw('SUM(product_orders.quantity) as carton'))
                        ->groupBy('name')
                        ->get();
                } else {
                    $p = ProductOrder::leftjoin('products', 'products.id', 'product_orders.product_id')
                        ->where('product_orders.user_id', $value->user_id)
                        ->select('products.name as name', DB::raw('SUM(product_orders.quantity) as carton'))
                        ->groupBy('name')
                        ->get();
                }
                return $p;
            });

        $products = $product->first();
        return response()->json([
            'html' => view('admin.customer.getmasterPicklist', compact('products', 'warehouse'))->render(), 200, ['Content-Type' => 'application/json']
        ]);
    }

    /////////////////All set Work///////////////
    public function getrunPicklist()
    {
        $date = Carbon::now();
        $current_day = Carbon::Today()->format('l');
        $currentday = Carbon::Today()->format('N');
        $dayID = WeekDay::where('name', $current_day)->pluck('id');
        if (isset(request()->id))
            $warehouse = Warehouse::whereId(request()->id)->first();
        else
            $warehouse = Warehouse::first();
         $arr = [];
         $products =[];
           $region=Region::whereWarehouseId($warehouse->id)->get();
          foreach ($region as $key => $value) {
              $data=ProductOrder::join('regions','regions.name','product_orders.region_name')
              ->join('zones','zones.name','product_orders.zone_name')
              ->select('product_orders.zone_name as zoneName',DB::raw('sum(product_orders.quantity) as carton'))
              ->groupBy('zoneName')
              ->where('regions.id',$value->id)
              ->get();
            //   dd($data);
            foreach ($data as $key => $value) {
                // dump($value->zoneName);
                   $arr= [
                                        'zoneName' => $value->zoneName,
                                        'carton'   => $value->carton,
                    ];
                    array_push($products,$arr);
            }
            // dd("dkkdk");
            //   $data=ProductOrder::whereRegionName($value->name)->get();
           
                   
          }
        //   dd($products);

        $zones = Zone::whereStatus(1)->get();
   
        return response()->json([
            'html' => view('admin.customer.getrunPicklist', compact('current_day', 'zones','warehouse', 'date','products'))->render(), 200, ['Content-Type' => 'application/json']
        ]);
    }
    public function batchPickists($zone)
    {
        $day = date('N', strtotime(date('Y-m-d')));
        $arr = [];
        $namearr=[];
        $users =[];
             $products=Product::join('product_orders','product_orders.product_id','products.id')
             ->select('products.name as name','product_orders.user_id as userId',DB::raw('sum(product_orders.quantity) as quantity'))
             ->where('product_orders.zone_name',$zone)
             ->groupBy('name','userId')
             ->get();
             foreach ($products as $key => $value) {
                $arr=[
                             'userId' => $value['userId'],
                        ];  
                        if(!in_array($arr['userId'],$namearr))
                        {
                            array_push($namearr,$arr['userId']);
                            array_push($users,$arr);
                        }  
             }
            // return view('admin.customer.forpdfnew',compact('products','users'));
            $pdf = PDF::setOptions(['images' => true, 'debugCss' => true, 'isPhpEnabled' => true, 'isRemoteEnabled' => true])->loadView('admin.customer.forpdfnew', compact('products','users'))->setPaper('a4', 'porttrait');
            return  $pdf->download('statement.pdf');
    }
    public function deliverySchedulePrint($zone)
    {
        $products=CustomerDetail::join('product_orders','product_orders.user_id','customer_details.user_id')
        ->select('product_orders.user_id as id',DB::raw('sum(product_orders.quantity) as carton'))
        ->where('product_orders.zone_name',$zone)
        ->groupBy('id')
        ->get();
        $pdf = PDF::setOptions(['images' => true, 'debugCss' => true, 'isPhpEnabled' => true, 'isRemoteEnabled' => true])->loadView('admin.customer.deliverySchedulePrint', compact('products','zone'))->setPaper('a4', 'porttrait');
        return  $pdf->download('statement.pdf');
    //   return view('admin.customer.deliverySchedulePrint',compact('products','zone'));
    }
    public function runPicklistPrint($zone)
    {
        $arr = [];
        $namearr=[];
        $products =[];
             $products=Product::join('product_orders','product_orders.product_id','products.id')
             ->select('products.name as name',DB::raw('sum(product_orders.quantity) as carton'))
             ->where('product_orders.zone_name',$zone)
             ->groupBy('name')
             ->get();
            $pdf = PDF::setOptions(['images' => true, 'debugCss' => true, 'isPhpEnabled' => true, 'isRemoteEnabled' => true])->loadView('admin.customer.picklistPrint', compact('products','zone'))->setPaper('a4', 'porttrait');
            return  $pdf->download('statement.pdf');
            // return view('admin.customer.picklistPrint',compact('products','zone'));
    }
   public function runPicklistView($zone)
   {
    $arr = [];
    $namearr=[];
    $products =[];
    //   $region=Region::whereWarehouseId($id)->get();

    //  foreach ($region as $key => $value) {
         $products=Product::join('product_orders','product_orders.product_id','products.id')
         ->select('products.name as name',DB::raw('sum(product_orders.quantity) as carton'))
         ->where('product_orders.zone_name',$zone)
         ->groupBy('name')
         ->get();
        //  foreach ($data as $key => $value) {
        //      $arr=[
        //          'name' => $value['pname'],
        //           'carton'=>$value['quantity'],
        //     ];  
        //     if(!in_array($arr['name'],$namearr))
        //     {
        //         array_push($namearr,$arr['name']);
        //         array_push($products,$arr);
        //     }  
        //     else
        //     {
        //         foreach ($products as $key => $value) {
        //             if($value['name'] == $arr['name'])
        //             {
        //                 $products[$key]['carton']=$value['carton'] +$arr['carton'];
        //             }
        //         }
        //     }
        //  }                           
    //  }
    //  dd("dkdk");
        //   dd($products);
        // $pdf = PDF::setOptions(['images' => true, 'debugCss' => true, 'isPhpEnabled' => true, 'isRemoteEnabled' => true])->loadView('admin.customer.picklistPrint', compact('products','zone'))->setPaper('a4', 'porttrait');
        // return  $pdf->download('statement.pdf');
        return view('admin.customer.picklistPrint',compact('products','zone'));
}
     public function purchasingHistory($id)
     {
        $currentWeek = date('W');
         $v=ProductOrder::orderBy('updated_at','asc')->first()->updated_at;
       $pastWeek =Carbon::parse($v)->format('W');
        $products= Product::all();
        $orders = $products->map(function($p) use ($id) {                   
            $p->productscount = ProductOrder::where('product_id', $p->id)->orderBy('updated_at','desc')->where('user_id',$id )->latest()->get()->groupBy(function($date) {
             return Carbon::parse($date->updated_at)->format('W');
            });
            return $p;                
        });

         return view('admin.customer.purchasingHistory',compact('orders','currentWeek','pastWeek'));
     }
     public function allocatePayment($id,$name,$price,$start,$end)
     {
        return view('admin.customer.allocatePayment',compact('id','name','price','start','end'));
     }
      public function customerOwingReport()
     {
       return view('admin.customer.customerOwingReport');
     }
     public function saveAllocatePayment()
     {
         $data=AllocatePayment::create(request()->all());
          if($data)
          {
            return redirect()->back()->with('success', 'Payment Allocated Successfully');   
          }
          else
          {
            return redirect()->back()->with('error', 'Error in  Allocatting Payment');   
          }
     }

    function searchdriver($zoneId)
    {
        // $assignDriver = AssignDriverOrder::where('customer_id',$user_id)->where('is_assign',1)->first('driver_id');
        $assignDriver = AssignDriver::where('zone_id', $zoneId)->first();
        if (!empty($assignDriver)) {
            $driver = User::where('id', $assignDriver->driver_id)->first();

            if (!empty($driver)) {
                return $driver->name;
            }
        }
        return false;
    }

    public function selectCustomer(Request $request)
    {
        extract($request->all());

        if ($request->has('customer_id')) {
            foreach ($customer_id as $customer) {
                $date = Carbon::now();
                $current_time = $date->toDateTimeString();
                $current_day = Carbon::Today()->format('l');
                $dayID = WeekDay::where('name', $current_day)->pluck('id');
                $todayOrder = ProductOrder::where('day_id', $dayID)->where('user_id', $customer)->get()->toArray();
                $orderID = array_column($todayOrder, 'id');
                $order =  implode(",", $orderID);
                $data[] = array(
                    'customer_id' => $customer,
                    'order_id' => $order,
                    'driver_id' => $driver_id,
                    'is_assign' => 1,
                    'created_at' => $current_time
                );
            }
            $assign =  AssignDriverOrder::insert($data);

            foreach ($customer_id as $customer) {
                $this->generateNotification($customer, $driver_id);
            }
            if ($assign) {
                $data1['status'] = 200;
                $data1['message'] = 'Driver Assign Successfully!';
            } else {
                $data1['status'] = 401;
                $data1['message'] = 'Driver Does Not Assign!';
            }
            return response()->json($data1);
        }
    }
    function generateNotification($customerID, $driverID)
    {
        $now = Carbon::now();
        $user = User::where('id', $customerID)->first();
        $driverMessage = auth()->user()->name . ' Has Assign You Delivery' . ' ' . $user->name . ' ' . $now->format('g:i A');
        $date = Carbon::now();
        $current_day = Carbon::Today()->format('l');
        $dayID = WeekDay::where('name', $current_day)->pluck('id');
        $todayOrder = ProductOrder::where('day_id', $dayID)->where('user_id', $customerID)->get()->toArray();
        $orderID = array_column($todayOrder, 'id');
        $order =  implode(",", $orderID);

        DriverNotification::create([
            'order_id' => $order,
            'driver_id' => $driverID,
            'message' => $driverMessage,
        ]);
    }

    /**
     *****************************************************************************
     ************************** Admin Password ***********************************
     *****************************************************************************
     */

    public function setting(Request $request)
    {
        if ($request->isMethod('post')) {
            dd($request->all());
        }
        return view('admin.setting');
    }
    public function scriptSetting(Request $request)
    {
        $result = Setting::all();
        return view('admin.scriptSetting', compact('result'));
    }
    public function saveSetting(Request $request)
    {
        foreach ($request->except('_token') as $key => $value) {
                $v=Setting::where('name',$key)->first();
                $v->value = $value;
                $v->save();
        }
        return redirect()->back();
    }

    public function checkPassword(Request $request)
    {
        $user = Auth::user();
        $data = $request->all();
        if (Hash::check($data['current_password'], $user->password)) {
            echo "true";
        } else {
            echo "false";
        }
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();
        $rules = [
            'current_password' => 'required',
            'new_password' => 'required|min:6|max:32',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $data = $request->all();
        if (Hash::check($data['current_password'], $user->password)) {
            if ($data['new_password'] == $data['confirm_password']) {
                User::where('id', $user->id)->update(['password' => bcrypt($data['new_password'])]);
                return redirect()->back()->with(['success' => 'Password Has Been Updated Successfully!']);
            } else {
                return redirect()->back()->with(['error' => 'New Password & Confirm Password NOT MATCH']);
            }
        } else {
            return redirect()->back()->with(['error' => 'Your Current Password is INCORRECT']);
        }
        return redirect()->back();
    }
}
