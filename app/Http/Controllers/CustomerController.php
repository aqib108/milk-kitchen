<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\DataTables;
use App\Models\CustomerDetail;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Auth;
use App\Models\Product;
use App\Models\WeekDay;
use App\Models\ProductOrder;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Validator;
class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }



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
                'message' => 'The email is available'
            ]);
        }
    }
    ///////////////////////////////
    //***** Customer's *****//
   //////////////////////////////

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
        $customerID = $id;
        $customerDetail = CustomerDetail::where('user_id',$customerID)->first();
        // $user = Auth::user()->id;
        // $customerDetail = CustomerDetail::where('user_id',$request->id)->first();
        $products = Product::orderBy('id','DESC')->where('status',1)->get();
        $weekDays = WeekDay::with('orderByUserID')->get();
        // $data['countries'] = Country::get(["name","id"]);
        // $data['regions'] = State::get(["name","id"]);
        // $data['cities'] = City::get(["name","id"]);

        return view('admin.customer.viewCustomer',compact('customerID','customerDetail','products','weekDays'));
    }

    //Create Customer page
    public function newCustomerCreate()
    {
        return view('admin.customer.createCustomer');
    }

    //Create New Customer
    public function createCustomer(Request $request)
    {
        $data = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

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
        return view('admin.customer.editCustomer',compact('customer'));
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

        return redirect()->route('customer.index')->with('success','Customer updated successfully');
    }

    //Customer reports
    public function customerReport()
    {
        return view('admin.customer.customerReport');
    }
}
