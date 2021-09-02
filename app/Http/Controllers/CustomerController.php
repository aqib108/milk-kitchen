<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\ProductOrder;
use App\Models\CustomerDetail;
use App\Models\WeekDay;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Auth;
use Validator;
use PDF;
class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    ///////////////////////////////
    //***** Customer's *****//
   //////////////////////////////

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
            $data = User::role('customer')->get(); 
            return Datatables::of($data) 
            ->editColumn('created_at', function (User $data) {
                return $data->created_at->format('d, M Y'); 
              })
                ->addIndexColumn()
                ->addColumn('action', function(User $data){
                    $btn = '<a data-id="'.$data->id.'" data-tab="Customer" data-url="customer/customerDelete" 
                    href="javascript:void(0)" class="del_btn btn btn-sm btn-danger">Delete</a>';
                    $btn2 = '<a href="customer/edit/'.$data->id.'" class="btn btn-sm btn-primary">Edit</a>';
                    return $btn.' '.$btn2;
                    
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.customer.customers');
    }

    //Create Customer page
    public function newCustomerCreate()
    {
        return view('admin.customer.createCustomer');
    }

    //Create New Customer
    public function createCustomer(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $data = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $data->assignRole('customer');
        return redirect()->route('customer.index')->with('success','New Customer Created!');
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

    public function reports(Request $request)
    {
        if ($request->ajax()) {
            $data = User::role('customer')->get(); 
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
        // $products = Product::orderBy('id','DESC')->where('status',1)->get();
        $orders = ProductOrder::where('user_id',$id)->with('product')->with('day')->get();      
        return view('admin.customer.pdfReport',compact('customer','orders'));

        // $pdf = PDF::loadView('admin.customer.pdfReport');
        // return $pdf->download('customerReport.pdf');
    }
}
