<?php

namespace App\Http\Controllers;

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
use App\Models\ProductOrder;
use App\Models\AssignDriverOrder;
use App\Models\DriverNotification;
use App\Models\Region;
use Carbon\Carbon;
use Spatie\Permission\Traits\HasRoles;
class AdminController extends Controller
{
    protected $userRepo; use HasRoles;
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
        return view('admin.index', compact('user'));
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
        } else {
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

        $product = Region::leftjoin('customer_details', 'customer_details.delivery_region', 'regions.region')
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
        $dayID = WeekDay::where('name', $current_day)->pluck('id');
        if (isset(request()->id))
            $warehouse = Warehouse::whereId(request()->id)->first();
        else
            $warehouse = Warehouse::first();
            $data = User::role('Driver')->where('status',1)
            ->join('assign_warehouses','assign_warehouses.user_id','users.id')
            ->where('warehouse_id',$warehouse->id)
             ->select('users.name as driverName','users.id as id')->get();
        
            $products = Region::leftjoin('customer_details', 'customer_details.delivery_region', 'regions.region')
                ->where('regions.warehouse_id', $warehouse->id)
                ->select('customer_details.user_id')
                ->get()->map(function ($value) use ($dayID) {
                    $p = ProductOrder::where('user_id',$value->user_id)->where('day_id',$dayID)
                        ->get();
                    return $p;
                });
            $orders = array();
            foreach($products as $pro)
            {
                $quantity = 0;
                $flag=0;
                foreach($pro as $p)
                {
                    $user_id = $p->user_id;
                    $userName = $p->user->name;
                    $userDetails = CustomerDetail::where('user_id',$p->user_id)->first(); 
                    $userAddress = $userDetails->delivery_address_1;
                    $userRegion = $userDetails->delivery_region;
                    $quantity = $quantity+$p->quantity;
                }

                $orders[] = array(
                    'user_id' => $user_id,
                    'userName'=>$userName,
                    'userAddress' => $userAddress,
                    'userRegion' => $userRegion,
                    'qty'=>$quantity,
                    'assign_driver'=>$this->searchdriver($user_id)
                );           
            }
             

        return response()->json([
            'html' => view('admin.customer.getrunPicklist', compact('current_day', 'date', 'orders', 'warehouse','data'))->render(), 200, ['Content-Type' => 'application/json']
        ]);
    }

    function searchdriver($user_id){
        $assignDriver = AssignDriverOrder::where('customer_id',$user_id)->where('is_assign',1)->first('driver_id');
        if(!empty($assignDriver)){
            $driver = User::where('id',$assignDriver->driver_id)->first();
            if(!empty($driver)){
                return $driver->name;
            }
        }
        return false;
    }

    public function selectCustomer(Request $request)
    {
        extract($request->all());
     
        if($request->has('customer_id'))
        {
            foreach($customer_id as $customer){
                $date = Carbon::now();
                $current_time = $date->toDateTimeString();
                $current_day = Carbon::Today()->format('l');
                $dayID = WeekDay::where('name', $current_day)->pluck('id');
                $todayOrder = ProductOrder::where('day_id',$dayID)->where('user_id',$customer)->get()->toArray();
                $orderID = array_column($todayOrder, 'id');
                $order =  implode(",",$orderID);
                $data[] = array(
                    'customer_id' => $customer,
                    'order_id' =>$order,
                    'driver_id'=>$driver_id,
                    'is_assign' =>1,
                    'created_at'=> $current_time       
                );  
            }
            $assign =  AssignDriverOrder::insert($data);

            foreach($customer_id as $customer)
            {
                $this->generateNotification($customer,$driver_id); 
            }
            if($assign){
                $data1['status'] = 200;
                $data1['message'] = 'Driver Assign Successfully!';
            }else{
                $data1['status'] = 401;
                $data1['message'] = 'Driver Does Not Assign!';
            }
            return response()->json($data1);
        } 
    }
    function generateNotification($customerID,$driverID)
    {
        $now = Carbon::now();
        $user = User::where('id',$customerID)->first();
        $driverMessage = auth()->user()->name .' Has Assign You Delivery'. ' ' .$user->name.' '. $now->format('g:i A');
        $date = Carbon::now();
        $current_day = Carbon::Today()->format('l');
        $dayID = WeekDay::where('name', $current_day)->pluck('id');
        $todayOrder = ProductOrder::where('day_id',$dayID)->where('user_id',$customerID)->get()->toArray();
        $orderID = array_column($todayOrder, 'id');
        $order =  implode(",",$orderID);
       
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
