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
       $weekDays = WeekDay::with('orderByUserID')->get();
       $data['countries'] = Country::where('status',1)->orderby('name','ASC')->get();
       $data['regions'] = State::where('status','1')->where('country_id',$customerDetail->business_country_id)->get();
       $data['cities'] = City::where('status','1')->where('state_id',$customerDetail->business_region_id)->get();

       return view('customer.index',compact('user','customerDetail','products','weekDays'),$data);
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
        $order = Product::with('orderByUserID')->get();
        // foreach($order as $ord){
        //     $day =  $ord['day_id'];
        //     $day_id = WeekDay::where('id', $day)->pluck('id');
        //     $product = $ord['product_id'];
        //     $product_id = Product::where('id',$product)->pluck('id');
        //     $pastorder = $ord->where('day_id',$day_id)->where('product_id',$product_id)->whereDate('created_at','>=', today()->startOfWeek()->subWeeks(10))->get();
        // }

        return view('customer.order-history',compact('order'));
    }
}
