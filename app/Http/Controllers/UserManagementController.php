<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Auth;
use DB;
use Yajra\DataTables\DataTables;

class UserManagementController extends Controller
{
    public function users(Request $request)
    {
        if ($request->ajax()) {
            $data = User::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('role', function(User $data) {
                    $roles = \Auth::user()->getRoleNames();
                    $role= $data->roles[0]->name;
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
                    $btn = '<a onclick="deleteRole('.$data->id.')" href="javascript:void(0)" class="btn btn-sm btn-danger">Delete</a>';
                    $btn2 = '<a href="javascript::void(0);" class="editPermission btn btn-sm btn-primary" data-id="'.$data->id.'">Edit</a>';
                    return $btn.' '.$btn2;
                })
                ->rawColumns(['action','status','role'])
                ->make(true);
        }

        // $users = 
        // $roles = \Auth::user()->getRoleNames();
        return view('admin.users.users');
    }

    public function editUser($id)
    {
        $user = User::find($id);
        $role = $user->roles->pluck('name');
        $roles = Role::all();
        return view('users.editUser',compact('user','role','roles'));
    }

    public function updateUser(Request $request,int $id)
    {
        $user = User::find($id);
        $role = $request->role;
        $user->syncRoles($role);
        return redirect('users');
    }

    public function addNewUser()
    {
        $roles = Role::all();
        return view('users.addUser',compact('roles'));
    }

    public function createNewUser(Request $request)
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

        $data->assignRole($request->role);
        return redirect('users')->with('success','New User has been created!');
    }

    public function deleteUser($id)
    {
        User::destroy($id);
        return back()->with('success', 'User Successfully deleted.');
    }

    public function roles(Request $request)
    {
        if ($request->ajax()) {
            $data = Role::with('permissions')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('permissions', function(Role $data) {
                    $permissions = Permission::pluck('name')->all();
                    $printIT = "";
                    foreach ($permissions as $permission)
                    {
                        $printIT .= '<span class="badge badge-success">' .$permission. '</span>';
                    }
                    return $printIT;
                })
                ->addColumn('action', function(Role $data){
                    $btn = '<a onclick="deleteRole('.$data->id.')" href="javascript:void(0)" class="btn btn-sm btn-danger">Delete</a>';
                    $btn2 = '<a href="javascript::void(0);" class="editPermission btn btn-sm btn-primary" data-id="'.$data->id.'">Edit</a>';
                    return $btn.' '.$btn2;
                })
                ->rawColumns(['action','permissions'])
                ->make(true);
        }


        return view('admin.users.roles');
    }

    public function editRole($id)
    {
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions=$role->permissions->pluck('id')->all();
        return view('users.editRoles',compact('role','permission','rolePermissions'));
    }

    public function updateRoles(Request $request, $id)
    {
        $role = Role::find($id);
        $role->syncPermissions($request->input('permissions',[]));
        return redirect('roles')->with('success','Role updated successfully');
    }

    public function deleteRole(Request $request)
    {
        try {
            $role = Role::findOrFail((int)$request->id);
            if ($role == null) {
                return redirect()->back()->with('error', 'No Record Found To Delete.');
            }

            $role->delete();
            return response()->json(['status' => 1, 'message' => 'Record deleted successfully.']);

        } catch (\Throwable $th) {
            return response()->json(['error' => 1, 'message' => 'The record could not be deleted.']);
        }
    }

    public function createRole(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles',
        ]);

        $role=Role::create(['name' => $request->name]);
         
        $role->syncPermissions($request->input('permissions',[]));
        return back()->with('success', 'Role Successfully Created.');
    }

    public function permissions(Request $request)
    {
       
        if ($request->ajax()) {
            $data = Permission::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function(Permission $data){
                    $btn = '<a onclick="deletePermission('.$data->id.')" href="javascript:void(0)" class="btn btn-sm btn-danger">Delete</a>';
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
        $per = Permission::find($id);
        $response = array(
            'id' => $per->id,
            'permission' => $per->name,
        );

        return response()->json($response);
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

    public function deletePermission(Request $request)
    {
        try {
            $permission = Permission::findOrFail((int)$request->id);
            if ($permission == null) {
                return redirect()->back()->with('error', 'No Record Found To Delete.');
            }

            $permission->delete();
            return response()->json(['status' => 1, 'message' => 'Record deleted successfully.']);

        } catch (\Throwable $th) {
            return response()->json(['error' => 1, 'message' => 'The record could not be deleted.']);
        }
    }
}
