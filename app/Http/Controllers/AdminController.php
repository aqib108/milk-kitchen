<?php

namespace App\Http\Controllers;

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
use App\Models\ProductOrder;
use App\Models\Region;

class AdminController extends Controller
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
    
    public function index()
    {
        $user = Auth::user();
        return view('admin.index',compact('user'));
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
        $days=  WeekDay::whereStatus(1)->get();
        if(auth()->user()->name != 'admin')
        {
            $warehouses=Warehouse::join('assign_warehouses','assign_warehouses.warehouse_id','warehouses.id')
            ->select('warehouses.*')->whereStatus(1)->get();
            
        }
        else{
            $warehouses=Warehouse::whereStatus(1)->get();
        }
        return view('admin.customer.masterPicklist',compact('warehouses','days'));
    }

    public function runPicklist()
    {
        $days=  WeekDay::whereStatus(1)->get();
        if(auth()->user()->name != 'admin')
        {
            $warehouses=Warehouse::join('assign_warehouses','assign_warehouses.warehouse_id','warehouses.id')
            ->select('warehouses.*')->whereStatus(1)->get();    
        }
        else
        {
            $warehouses=Warehouse::whereStatus(1)->get();
        }   
        return view('admin.customer.runPicklist',compact('warehouses','days'));
    }
    public function getmasterPicklist()
    {
                        if(isset(request()->id))
                            $warehouse= Warehouse::whereId(request()->id)->first();
                            else
                            $warehouse= Warehouse::first();
                      
                            $product= Region::leftjoin('customer_details','customer_details.delivery_region','regions.region')
                                 ->where('regions.warehouse_id',$warehouse->id)
                                 ->select('customer_details.user_id')
                                 ->get()->map(function($value){
                                if(!empty(request()->day_id))
                                {
                                    $p= ProductOrder::leftjoin('products','products.id','product_orders.product_id')
                                    ->where(['product_orders.user_id'=>$value->user_id,'product_orders.day_id' => request()->day_id])
                                    ->select('products.name as name','product_orders.quantity as corton','product_orders.created_at')
                                     ->get();
                                }
                                else
                                {
                                    $p= ProductOrder::leftjoin('products','products.id','product_orders.product_id')
                                    ->where('product_orders.user_id',$value->user_id)
                                    ->select('products.name as name','product_orders.quantity as corton','product_orders.created_at')
                                     ->get();
                                }
                                return $p;
                                    });
                                    $products=$product->first();
                    return response()->json([
                        'html' => view('admin.customer.getmasterPicklist', compact('products','warehouse'))->render()
                        ,200, ['Content-Type' => 'application/json']
                    ]);
    }

    public function getrunPicklist()
    {
         if(isset(request()->id))
            $warehouse= Warehouse::whereId(request()->id)->first();
            else
            $warehouse= Warehouse::first();
            $products=CustomerDetail::join('users','users.id','customer_details.user_id')
                                 ->join('product_orders','product_orders.user_id','customer_details.user_id')
                                 ->join('regions','regions.region','customer_details.delivery_region')
                                 ->where('regions.warehouse_id',$warehouse->id)
                                 ->select('users.name as name','customer_details.business_address_1 as address',
                                 'customer_details.delivery_region as subrub','product_orders.quantity as cartons')
                                ->get();
                        return response()->json([
                            'html' => view('admin.customer.getrunPicklist', compact('products','warehouse'))->render()
                            ,200, ['Content-Type' => 'application/json']
                        ]);            
    }
    /**
    *****************************************************************************
    ************************** Admin Password ***********************************
    *****************************************************************************
    */

    public function setting(Request $request)
    {
        if($request->isMethod('post')){
            dd($request->all());
        }
        return view('admin.setting');
    }

    public function checkPassword(Request $request)
    { 
        $user = Auth::user();
        $data = $request->all();
        if (Hash::check($data['current_password'],$user->password)) {
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
        if (Hash::check($data['current_password'],$user->password)) {
            if ($data['new_password'] == $data['confirm_password']) {
                User::where('id',$user->id)->update(['password'=>bcrypt($data['new_password'])]);
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
