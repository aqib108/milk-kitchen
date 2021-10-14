<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use Auth;
use App\Models\CustomerDetail;
use App\Models\Product;
use App\Models\Zone;
use App\Models\WeekDay;
use App\Models\ProductOrder;
use App\Models\OrderDeliverd;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Region;
use App\Models\Warehouse;
use Carbon\Carbon;
use DateTime;
use DB;


class HomeController extends Controller
{
    protected $userRepo;
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       $user = Auth::user()->id;
       $customerDetail = CustomerDetail::where('user_id',$user)->first();
       $deliveryRegion = $customerDetail->delivery_region ?? '';
       $ZoneID = Zone::join('regions','regions.id','zones.id')
        ->select('zones.id as id')->where('regions.region',$deliveryRegion ?? '')->get();
        $deliveryZoneDay =  DB::table('delivery_schedule_zones')->where('zone_id',$ZoneID[0]->id ?? '')->where('status',1)->pluck('day_id','day_id');
       $products = Product::orderBy('id','DESC')->where('status',1)->get();
       $weekDays = WeekDay::with(['WeekDay' => function($q) use ($user){
                    $q->userDetail($user);
                    }])->get();
       return view('customer.index',compact('user','customerDetail','products','weekDays','deliveryZoneDay'));
    }
    public function getState(Request $request)
    {
        // dd($request->all());
        $regions = State::where('country_id',$request->country_id)->get(['name','id']);
        return ['regions' =>$regions];
    }
    public function getCity(Request $request)
    {
        // dd($request->all());
        $cities = City::where('state_id',$request->state_id)->get(['name','id']);
        return ['cities' =>$cities];
    }

    public function productOrders(Request $request)
    {
        // dd($request->day_id);
        $validate = $request->validate([
            'day_id' => 'required',
            'product_id' => 'required',
            'qnty' => 'required',
        ]);
        
        if($validate){
            $data = ProductOrder::updateOrCreate([
                'user_id'    => Auth::id(),
                'region_name'  => $request->region,
                'day_id'     => $request->day_id,
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
    
    public  function pastOrder($id)
    {
        $orders = ProductOrder::with('product')->where('user_id',$id)->get()->groupBy(function($date) {
            return Carbon::parse($date->created_at)->startOfWeek()->subWeeks(10)->format('W'); // grouping by weeks
        });
        return view('customer.order-history',compact('orders'));
    }

    public function deliveryDetails(Request $request)
    {
        $request->validate([
            'id'=>'required'
        ]);
        $orderDetail = ProductOrder::find($request->id);
        $customerID = $orderDetail->user_id;
        $products = Product::orderBy('id','DESC')->where('status',1)->get();
        $weekDays = WeekDay::with(['productOrder' => function($q) use ($orderDetail){
                        $q->userDetail($orderDetail->user_id);
                    }])->with(['productOrder' => function($q) use ($orderDetail) {
                        $q->weekDetail($orderDetail);
                    }])->get();
        return response()->json([
            'html' => view('customer.specific_week_delivery', compact('customerID','weekDays','products'))->render()
            ,200, ['Content-Type' => 'application/json']
        ]);
    }
}
