<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Auth;
class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    ///////////////////////////////
    //***** Customer's *****//
   //////////////////////////////

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
            'email' => ['required', 'string', 'email', 'ends_with:gmail.com,yahoo.com', 'max:255', 'unique:users'],
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
            'email' => 'required|email|ends_with:gmail.com,yahoo.com',
        ]);
        
        $Customer = User::find($id);
        $Customer->name = $request->input('name');
        $Customer->email = $request->input('email');
        $Customer->save();

        return redirect()->route('customer.index')->with('success','Customer updated successfully');
    }

    ///////////////////////////////
    //*****Customer Group's*****//
   //////////////////////////////

   public function customerGroup(Request $request)
    {
        if ($request->ajax()) {
            $data = User::role('customer')->get(); 
            return Datatables::of($data)
            ->editColumn('created_at', function (User $data) {
                return $data->created_at->format('d, M Y'); 
              })
                ->addIndexColumn()
                ->addColumn('action', function(User $data){
                    $btn = '<a href="javascript:void(0)" class="btn btn-sm btn-danger">Delete</a>';
                    $btn2 = '<a href="javascript::void(0);" class="btn btn-sm btn-primary" data-id="'.$data->id.'">Edit</a>';
                    return $btn.' '.$btn2;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.customer.customerGroup');
    }

    public function customerReport()
    {
        return view('admin.customer.customerReport');
    }
}
