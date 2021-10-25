<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GroupCustomer;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;
use Auth;

class CustomerGroupController extends Controller
{
    ///////////////////////////////
    //*****Customer Group's*****//
   //////////////////////////////

   public function customerGroup(Request $request)
   {
       if ($request->ajax()) {
           $data = GroupCustomer::all(); 
           return Datatables::of($data)
            ->addColumn('status', function(GroupCustomer $data){
                if($data->status == 1){
                    $status = '<span class="badge badge-success">Active</span>';
                }
                else{
                    $status = '<span class="badge badge-danger">Suspended</span>';
                }
                return $status;
            })
            ->addIndexColumn()
            ->addColumn('action', function(GroupCustomer $data){
                $btn = '<a data-id="'.$data->id.'" data-tab="groupCustomer" data-url="customer-group/delete" 
                href="javascript:void(0)" class="del_btn btn btn-sm btn-danger">Delete</a>';
                $btn2 = '<a href="javascript::void(0);" class="editGroup btn btn-sm btn-primary" data-id="'.$data->id.'">Edit</a>';
                if($data->status == 1){
                    $status = '<a onclick="changeStatus('.$data->id.',0)" href="javascript:void(0)" class="btn btn-sm btn-danger ">Suspend</a>';
                }
                else{
                    $status = '<a onclick="changeStatus('.$data->id.',1)" href="javascript:void(0)" class="btn btn-sm btn-success">Activate</a>';
                }
                return $status.' '.$btn2.' '.$btn;
            })
            ->rawColumns(['action','status'])
            ->make(true);
       }
       return view('admin.customer.customerGroup');
   }

   public function addCustomerGroup()
   {
       return view('admin.customer.createCustomerGroup');
   }

   public function store(Request $request)
    {
        $validated = $request->validate([
           'group_name' => 'required|unique:group_customers',
        ]);

        $data = GroupCustomer::create([
           'group_name' => $request->group_name,
        ]);

       return redirect()->route('customer-group.index')->with('success','New Customer Group Created!');
    }

   public function status(Request $request)
   {
       $user = GroupCustomer::findOrFail($request->id);
       if ($user == null) {
           return redirect()->back()->with('error', 'No Record Found To Delete.');
       }
       $user->update(['status'=> $request->input('status')]);
       return response()->json(['status'=>'1','message'=>'Status Changed Successfully']);
   }

   public function delete($id)
   {
       $group = GroupCustomer::findOrFail($id);
       $group->delete();
       return response()->json(array(
           'data' => true,
           'message' => 'Customer Group Successfully Deleted',
           'status' => 'success',
       ));
   }

   public function editGroup($id)
   {
       $customer = GroupCustomer::find($id);
       if ($customer == null) {
        return redirect()->back()->with('error', 'No Record Found To Edit.');
    }

    $group = array(
        'id' => $customer->id,
        'group_name' => $customer->group_name,
    );

    return response()->json($group);
   }

   public function updateGroup(Request $request,$id)
   {
       $this->validate($request, [
           'group_name' => 'required|string',
       ]);
       
       $Customer = GroupCustomer::find($id);
       $Customer->group_name = $request->input('group_name');
       $Customer->save();

       return redirect()->route('customer-group.index')->with('success','Customer Group updated successfully');
   }

}
