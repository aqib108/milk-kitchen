<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use Auth;
use App\Models\CustomerDetail;
use App\Models\Product;
use App\Models\WeekDay;
use App\Models\ProductOrder;
use App\Models\Country;
use App\Models\State;
use App\Models\City;


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
       $data['countries'] = Country::get(["name","id"]);
       $data['regions'] = State::get(["name","id"]);
       $data['cities'] = City::get(["name","id"]);

       return view('customer.index',compact('user','customerDetail','products','weekDays'),$data);
    }
    public function getState(Request $request)
    {
        $data['states'] = State::where("country_id",$request->country_id)
                    ->get(["name","id"]);
        return response()->json($data);
    }
    public function getCity(Request $request)
    {
        $data['cities'] = City::where("state_id",$request->state_id)
                    ->get(["name","id"]);
        return response()->json($data);
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
                'quantity' => $request->qnty
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
}
