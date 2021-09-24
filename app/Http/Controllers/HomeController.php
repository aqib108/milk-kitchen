<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use Auth;
use App\Models\CustomerDetail;
use App\Models\Product;
use App\Models\WeekDay;
use App\Models\ProductOrder;
use App\Models\OrderDeliverd;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Carbon\Carbon;
use DateTime;


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
       $products = Product::orderBy('id','DESC')->where('status',1)->get();
       $weekDays = WeekDay::with(['WeekDay' => function($q) use ($user){
                    $q->userDetail($user);
                    }])->get();
       $countries = Country::where('status',1)->orderby('name','ASC')->get();
       if ($customerDetail != NULL) {
            $regions = State::select('id', 'country_id', 'name')->orderBy('name', "ASC")->where('status', 1)->where('country_id', $customerDetail->business_country_id)->get();
        } else {
            $regions = null;
        }

        if ($customerDetail != NULL) {
            $cities = City::select('id', 'state_id', 'name')->orderBy('name', "ASC")->where('status', 1)->where('state_id', $customerDetail->business_region_id)->get();
        } else {
            $cities = null;
        }

        if ($customerDetail != NULL) {
            $dregions = State::select('id', 'country_id', 'name')->orderBy('name', "ASC")->where('status', 1)->where('country_id', $customerDetail->delivery_country_id)->get();
        } else {
            $dregions = null;
        }

        if ($customerDetail != NULL) {
            $dcities = City::select('id', 'state_id', 'name')->orderBy('name', "ASC")->where('status', 1)->where('state_id', $customerDetail->delivery_region_id)->get();
        } else {
            $dcities = null;
        }
       
       return view('customer.index',compact('user','customerDetail','products','weekDays','regions','cities','countries','dregions','dcities'));
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
        $products = Product::orderBy('id','DESC')->where('status',1)->get();
        $weekDays = WeekDay::with(['productOrder' => function($q) use ($orderDetail){
                        $q->userDetail($orderDetail->user_id);
                    }])->with(['productOrder' => function($q) use ($orderDetail) {
                        $q->weekDetail($orderDetail);
                    }])->get();
        return response()->json([
            'html' => view('customer.specific_week_delivery', compact('weekDays','products'))->render()
            ,200, ['Content-Type' => 'application/json']
        ]);
    }
}
