<?php

namespace App\Http\Controllers;

use App\Models\AssignGroup;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Setting;
use App\Models\Product;
use App\Models\ProductOrder;
use App\Models\StandingOrder;
use App\Models\OrderDeliverd;
use App\Models\CustomerDetail;
use App\Models\WeekDay;
use App\Models\DeliverySheduleZone;
use App\Models\Zone;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\GroupCustomer;
use App\Models\Service;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Carbon\Carbon;
use Auth;
use Validator;
use PDF;
use DB;
class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    //Email validation's
    public function checkEmail(Request $request)
    {
        $input = $request->only(['email']);

        $request_data = [
            'email' => 'required|email|unique:users,email|ends_with:.com',
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
                'message' => "<span style='color:#95d60c;'>The email is available</span>"
            ]);
        }
    }

   //Display all customers
    public function customers(Request $request)
    {
        if ($request->ajax()) {
            $data = User::role('Customer')->get(); 
            return Datatables::of($data) 
            ->editColumn('created_at', function (User $data) {
                return $data->created_at->format('d, M Y'); 
              })
                ->addIndexColumn()
                ->addColumn('view',function(User $data){
                    $btn2 = '<a href="'.route('customer.customerView',$data->id).'" class="btn btn-sm btn-primary">View</a>';
                    return $btn2; 
                })
                ->addColumn('action', function(User $data){
                    $btn = '<a data-id="'.$data->id.'" data-tab="Customer" data-url="customer/customerDelete" 
                    href="javascript:void(0)" class="del_btn btn btn-sm btn-danger">Delete</a>';
                    $btn2 = '<a href="customer/edit/'.$data->id.'" class="btn btn-sm btn-primary">Edit</a>';
                    return $btn.' '.$btn2;    
                })
                ->rawColumns(['action','view'])
                ->make(true);
        }
        return view('admin.customer.customers');
    }

    public function viewCustomer($id)
    {

        $cutt_of_time=Setting::whereName('Cutt Off Time')->first();
        $products=AssignGroup::join('users','users.id','assign_groups.user_id')
           ->where('assign_groups.user_id',$id)
           ->select('assign_groups.assign_group_id as groupId')
           ->get()->map(function($value){
            $p=Service::where('services.product_id',$value->groupId)
            ->join('assign_groups','assign_groups.assign_group_id','services.group_id')
            ->join('products','products.id','services.product_id')
            // ->join('product_orders','product_orders.product_id','services.product_id')
             ->select('products.*')
            //  ->select('products.name as productName','product_orders.day_id as Day',DB::raw('SUM(product_orders.quantity) as carton'))
            //  ->groupBy('productName','Day')
             ->distinct()->first();
             return $p;
           });
         
     
        // dd("dkdk");
        $customerID = $id;
         
       
           
        $customer = User::find($customerID);
        $customerDetail = CustomerDetail::where('user_id',$customer->id)->first();
        $deliveryRegion = $customerDetail->delivery_region ?? '';
        // $ZoneID = Zone::join('regions','regions.id','zones.id')
        // ->select('zones.id as id')->where(['regions.region'=>$customerDetail->delivery_region,
        // 'zones.name'=>$customerDetail->delivery_zone])->get();
        $ZoneID = Zone::where('name',$customerDetail->delivery_zone ?? '')->first();
        $deliveryZoneDay =  DB::table('delivery_schedule_zones')->where('zone_id',$ZoneID->id ?? '')->where('status',1)->pluck('day_id','day_id');
     
        // $products = Product::orderBy('id','DESC')->where('status',1)->get();
       
        // dd("dmdk");  
        $weekDays = WeekDay::with(['WeekDay' => function($q) use ($customerID,$deliveryRegion){
            $q->userDetail($customerID,$deliveryRegion);
        }])->get();
        $WeekDayForStandingOrder = WeekDay::with(['WeekDayForStandingOrder' => function($q) use ($customerID,$deliveryRegion){
            $q->userDetail($customerID,$deliveryRegion);
        }])->get();
       
        return view('admin.customer.viewCustomer',compact('customerID','cutt_of_time','customer','customerDetail','products','weekDays','deliveryZoneDay','WeekDayForStandingOrder'));
    }

    public function pastOrder($id)
    {
        $customer = User::find($id);
        $orders = ProductOrder::with('product')->where('user_id',$customer->id)->get()->groupBy(function($date) {
            return Carbon::parse($date->created_at)->startOfWeek()->subWeeks(10)->format('W'); // grouping by weeks
        });
        return view('admin.customer.past-order',compact('orders'));
    }

    public function pastOrderStatement($id)
    {
        $orderDetail = ProductOrder::find($id);
        $customerID = $orderDetail->user_id;
        $customer = CustomerDetail::where('user_id',$customerID)->get();
        $products = Product::orderBy('id','DESC')->where('status',1)->get();
        $weekDays = WeekDay::with(['productOrder' => function($q) use ($orderDetail){
                        $q->userDetail($orderDetail->user_id);
                    }])->with(['productOrder' => function($q) use ($orderDetail) {
                        $q->weekDetail($orderDetail);
                    }])->get();
        // dd($weekDays);

       return view('admin.customer.past-order.statement',compact('customerID','orderDetail','customer','products','weekDays'));
    }

    //Create Customer page
    public function newCustomerCreate()
    {
         $groups= GroupCustomer::whereStatus(1)->get();
         $arr= array('');
        return view('admin.customer.createCustomer',compact('groups','arr'));
    }

    //Create New Customer
    public function createCustomer(Request $request)
    {
        $data = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $data->assignRole('Customer');
         $data->groups()->sync($request->groups);
        if($data->wasRecentlyCreated){
            $response = array(
                'data' => [],
                'message' => 'Data Successfully Added',
                'status' => 'success',
            );
            return $response;        
        }
    }

    //Delete Customer
    public function deleteCustomer($id)
    {
        $customer = User::findOrFail($id);
        $customer->delete();
        return response()->json(array(
            'data' => true,
            'message' => 'Customer Successfully Deleted',
            'status' => 'success',
        ));
    }

    //Edit Customer page
    public function editCustomer($id)
    {
        $customer = User::find($id);
        $groups= GroupCustomer::whereStatus(1)->get();
        $arr=GroupCustomer::join('assign_groups','assign_groups.assign_group_id','group_customers.id')
        ->where('assign_groups.user_id',$customer->id)
        ->select('group_customers.*')->pluck('id')->toArray(); 
        return view('admin.customer.editCustomer',compact('customer','arr','groups'));
    }

    //Update Customer
    public function updateCustomer(Request $request,$id)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email',
        ]); 
        $Customer = User::find($id);
        $Customer->name = $request->input('name');
        $Customer->email = $request->input('email');
        $Customer->save();
        $Customer->groups()->sync($request->groups);
      

        return redirect()->route('customer.index')->with('success','Customer updated successfully');
    }

    //Customer reports
    public function customerReport()
    {
        return view('admin.customer.customerReport');
    }

    public function reports(Request $request)
    {
        if ($request->ajax()) {
            $nilai = DB::table('product_orders')->distinct()->pluck('user_id');
            $data = User::whereIn('id',$nilai)->get();
            return Datatables::of($data) 
                ->addIndexColumn()
                ->addColumn('action', function(User $data){
                    $btn = '<a href="generate-pdf/'.$data->id.'" class="btn btn-sm btn-info">View</a>';
                    return $btn; 
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.customer.report');
    }

    public function generatePDF($id)
    {
        $customer = CustomerDetail::where('user_id',$id)->with('user')->with('bcountry')->with('bstate')->with('bcity')->with('dcountry')->with('dstate')->with('dcity')->get();
        $getCustomer = ProductOrder::where('user_id',$id)->distinct()->pluck('product_id');
        $products = Product::whereIn('id',$getCustomer)->get();
        $orders = ProductOrder::where('user_id',$id)->get();
        $weekDays = WeekDay::with(['WeekDay' => function($q) use ($id){
            $q->userDetail($id);
        }])->get(); 
        return view('admin.customer.pdfReport',compact('customer','products','weekDays','orders'));

        // $pdf = PDF::loadView('admin.customer.pdfReport',compact('customer','products','weekDays','orders'));
        // return $pdf->download('customerReport.pdf');
    }

    public function productOrderAdmin(Request $request,$id)
    {
        $validate = $request->validate([
            'day_id' => 'required',
            'product_id' => 'required',
            'qnty' => 'required',
        ]);

        $customerID = $id;
        $customer = User::find($customerID);
        
        if($validate){
            $data = ProductOrder::updateOrCreate([
                'user_id'    => $customer->id,
                'day_id'     => $request->day_id,
                'region_name'  => $request->region,
                'product_id' => $request->product_id],[
                'quantity' => $request->qnty,
            ]);
            if($data->wasRecentlyCreated){
                return response()->json([
                    'status' => true,
                    'message' => 'Your Order Successfully created',
                ]);
            }else{
                return response()->json([
                    'status' => true,
                    'message' => 'Your Order Successfully updated',
                ]);
            }
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong, Please try again!',
            ],401);
        }
    }
    public function StandingOrderAdmin(Request $request,$id)
    {
        $validate = $request->validate([
            'day_id' => 'required',
            'product_id' => 'required',
            'qnty' => 'required',
        ]);

        $customerID = $id;
        $customer = User::find($customerID);
        
        if($validate){
            $data = StandingOrder::updateOrCreate([
                'user_id'    => $customer->id,
                'day_id'     => $request->day_id,
                'region_name'  => $request->region,
                'product_id' => $request->product_id],[
                'quantity' => $request->qnty,
            ]);
            if($data->wasRecentlyCreated){
                return response()->json([
                    'status' => true,
                    'message' => 'Your Order Successfully created',
                ]);
            }else{
                return response()->json([
                    'status' => true,
                    'message' => 'Your Order Successfully updated',
                ]);
            }
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong, Please try again!',
            ],401);
        }
    }

    public function packingslip()
    {
        return view('admin.customer.packingslip');
    }

    public function finalreport($id)
    {
        if($id == 0){
            return redirect()->back()->with('success','No Record Found To This Delivery!.');
        }else{
            $orderDetail = ProductOrder::find($id);
            if ($orderDetail == NULL) {
                return redirect()->back()->with('error','No Record Found');
            }
            $customerID = $orderDetail->user_id;
            $customer = CustomerDetail::where('user_id',$customerID)->get();
            $products = Product::orderBy('id','DESC')->where('status',1)->get();
            $deliverOrder = ProductOrder::where('day_id',$orderDetail->day_id)->where('user_id',$customerID)->where('product_id',$orderDetail->product_id)->get();
                
            $weekDays = 
                WeekDay::with(['productOrder' => function($q) use ($customerID){
                    $q->userDetail($customerID);
                }])->with(['productOrder' => function($q) use ($orderDetail,$deliverOrder) {
                    $q->weekDetail($orderDetail);
                }])->get();

           
            // dd($weekDays);
            return view('admin.customer.finalreport',compact('orderDetail','customerID','customer','products','weekDays'));
        }
       
    }
    
    public function editDeliveryOrders(Request $request,$id)
    {
        $userID = $id;
        $order = ProductOrder::where('day_id',$request->day_id)->where('user_id',$userID)->where('product_id',$request->product_id)->get();
        $validate = $request->validate([
            'product_id' => 'required',
            'qnty' => 'required',
        ]);
        
        if($validate){
            $data = OrderDeliverd::updateOrCreate([
                'product_order_id' => $order[0]->id],[
                'quantity' => $request->qnty,
            ]);
            
            return response()->json([
                'status' => true,
                'message' => 'Your Record Successfully updated',
            ]);
            
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong, Please try again!',
            ],401);
        }
    }

    public function statementPrint($id)
    {
        ini_set('max_execution_time', 300); //300 seconds = 5 minutes 
        $order = ProductOrder::find($id);
        $customerID = $order->user_id;
        $customer = CustomerDetail::where('user_id',$customerID)->get();
        $products = Product::orderBy('id','DESC')->where('status',1)->get();
        $weekDays = WeekDay::with(['productOrder' => function($q) use ($order){
                        $q->userDetail($order->user_id);
                    }])->with(['productOrder' => function($q) use ($order) {
                        $q->weekDetail($order);
                    }])->get();
        $image = base64_encode(file_get_contents(public_path('/admin-panel/images/logo.png')));
        $pdf = PDF::setOptions(['images' => true, 'debugCss' =>true, 'isPhpEnabled'=>true,'isRemoteEnabled' => TRUE,])->loadView('admin.customer.pdfReport',['weekDays' => $weekDays,'products' => $products,'customer' => $customer,'image' => $image,'order'=>$order])->setPaper('a4', 'porttrait');
        return $pdf->download('report.pdf');
    }
}
