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
                    $btn = '<a onclick="deleteCustomer('.$data->id.')" href="javascript:void(0)" class="btn btn-sm btn-danger">Delete</a>';
                    $btn2 = '<a href="javascript::void(0);" class="editCustomer btn btn-sm btn-primary" data-id="'.$data->id.'">Edit</a>';
                    return $btn.' '.$btn2;
                    
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.customer.customers');
    }

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
        return back()->with('success','New Customer Created!');
    }

    public function deleteCustomer(Request $request)
    {
        $customer = User::findOrFail($request->id);
        $customer->delete();
        return response()->json(['status' => 1, 'message' => 'Record deleted successfully.']);
    }

    public function editCustomer($id)
    {
        $cus = User::find($id);
        $response = array(
            'id' => $cus->id,
            'name' => $cus->name,
            'email' => $cus->email,
            // 'password' =>  Hash::make($cus->password),
        );

        return response()->json($response);
    }

    public function updateCustomer(Request $request,$id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
        ]);
        
        $Customer = User::find($id);
        $Customer->name = $request->input('name');
        $Customer->email = $request->input('email');
        $Customer->save();

        return back()->with('success','Customer updated successfully');
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