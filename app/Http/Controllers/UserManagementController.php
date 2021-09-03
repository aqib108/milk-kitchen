<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Auth;
use DB;
use Validator;
use Yajra\DataTables\DataTables;

class UserManagementController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function users(Request $request)
    {
        if ($request->ajax()) {
            $data = User::where('id','!=',Auth::id())->whereHas('roles', function ($query) {
                return $query->where('name','!=', 'Customer');
            })->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('role', function(User $data) {
                    $roles = \Auth::user()->getRoleNames();
                    $role= $data->roles->pluck('name')->all();
                    return $role;
                })
                ->addColumn('status', function(User $data){

                    if($data->status == 1){
                        $status = '<span class="badge badge-success">Active</span>';
                    }
                    else{
                        $status = '<span class="badge badge-danger">Suspended</span>';
                    }
                    return $status;
                })
                ->addColumn('action', function(User $data){
                    if($data->status == 1){
                        $status = '<a onclick="changeStatus('.$data->id.',0)" href="javascript:void(0)" class="btn btn-sm btn-danger ">Suspend</a>';
                    }
                    else{
                        $status = '<a onclick="changeStatus('.$data->id.',1)" href="javascript:void(0)" class="btn btn-sm btn-success">Activate</a>';
                    }
                    $btn2 = '<a href="'.route('user.edit',$data->id).'"class="editPermission btn btn-sm btn-primary" data-id="'.$data->id.'">Edit</a>';
                    return $status.' '.$btn2;
                })
                ->rawColumns(['action','status','role'])
                ->make(true);
        }
        return view('admin.users.users');
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        if ($user == null) {
            return redirect()->back()->with('error', 'No Record Found To Edit.');
        }
        $role = $user->roles->pluck('name');
        $roles = Role::where('name','!=','Customer')->get();

        return view('admin.users.editUser',compact('user','role','roles'));
    }

    public function status(Request $request)
    {
        $user = User::findOrFail($request->id);
        if ($user == null) {
            return redirect()->back()->with('error', 'No Record Found To Delete.');
        }
        $user->update(['status'=> $request->input('status')]);
        $status = $user->status;
        return response()->json(['status'=>$status,'message'=>'Status Changed Successfully']);
    }

    public function updateUser(Request $request,int $id)
    {
        $user = User::findOrFail($id);
        if ($user == null) {
            return redirect()->back()->with('error', 'No Record Found To Update.');
        }
        $role = $request->role;
        $user->syncRoles($role);

        return redirect()->route('user.index')->with('success','Your Record Sucessfully Updated!');
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
                'message' => "<span style='color:#95d60c;'>The email is available</span>"
            ]);
        }
    }

    public function addNewUser()
    {
        $roles = Role::where('name','!=','Customer')->get();
        return view('admin.users.addUser',compact('roles'));
    }

    public function createNewUser(Request $request)
    {
        $data = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $data->assignRole($request->role);
        if($data->wasRecentlyCreated){
            $response = array(
                'data' => [],
                'message' => 'Data Successfully Added',
                'status' => 'success',
            );
            return $response;
        }
    }

    /**
     *****************************************************************************
     ************************** ROLES REQUEST ************************************
     *****************************************************************************
    */

    public function roles(Request $request)
    {
        $permissions = Permission::pluck('name')->all();
        if ($request->ajax()) {
            $data = Role::with('permissions')->where('name','!=','Customer')->where('name','!=','Admin')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('permissions', function(Role $data) {
                       $permissions=$data->permissions()->pluck('name')->all();
                    $printIT = "";
                    foreach ($permissions as $permission)
                    {
                        $printIT .= '<span class="badge badge-success">' .$permission. '</span>';
                    }
                    return $printIT;
                })
                ->addColumn('action', function(Role $data){
                    $btn = '<a href="'.route('role.edit',$data->id).'" class="btn btn-sm btn-primary">Edit</a>';
                    return $btn;
                })
                ->rawColumns(['action','permissions'])
                ->make(true);
        }
        return view('admin.users.roles',compact('permissions'));
    }

    public function editRole($id)
    {
        $role = Role::findOrFail($id);
        if ($role == null) {
            return redirect()->back()->with('error', 'No Record Found To Edit.');
        }
        $permission = Permission::get();
        $rolePermissions=$role->permissions->pluck('id')->all();
        return view('admin.users.editRoles',compact('role','permission','rolePermissions'));
    }

    public function updateRoles(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        if ($role == null) {
            return redirect()->back()->with('error', 'No Record Found To update.');
        }

        $validated = $request->validate([
            'permissions' => 'required|array'
        ]);

        $data = [ 'permissions' => $request->input('permissions',[]),];
        $role->syncPermissions($data);

        return redirect()->route('role.index')->with('success','Role updated successfully');
    }

    /**
     *****************************************************************************
     ************************** PERMISSIONS REQUEST ******************************
     *****************************************************************************
    */

    public function permissions(Request $request)
    {
        if ($request->ajax()) {
            $data = Permission::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function(Permission $data){
                    $btn = '<a data-id="'.$data->id.'" data-tab="Permission" data-url="permissions/delete" 
                    href="javascript:void(0)" class="del_btn btn btn-sm btn-danger">Delete</a>';
                    $btn2 = '<a href="javascript::void(0);" class="editPermission btn btn-sm btn-primary" data-id="'.$data->id.'">Edit</a>';
                    return $btn.' '.$btn2;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.users.permissions');
    }

    public function createPermission(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'unique:permissions', 'max:255'],
        ]);

        Permission::create(['name' => $request->name ]);
        return back()->with(['success', 'Permission has been created!']);
    }

    public function editPermission($id)
    {
        $per = Permission::findOrFail($id);
        if ($per == null) {
            return redirect()->back()->with('error', 'No Record Found To Edit.');
        }

        $data = array(
            'id' => $per->id,
            'permission' => $per->name,
        );

        return response()->json($data);
    }

    public function updatePermission(Request $request, $id)
    {
        $this->validate($request, [
            'permission' => 'required',
        ]);

        $permission = Permission::find($id);
        $permission->name = $request->input('permission');
        $permission->save();

        return redirect()->route('permission.index')->with('success','Permission updated successfully');
    }

    public function deletePermission($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();
        return response()->json(array(
            'data' => true,
            'message' => 'Permission Successfully Deleted',
            'status' => 'success',
        ));
    }
}
