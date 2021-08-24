<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Auth;
use DB;
class UserManagement extends Controller
{
    //////////////////////////////////
        //-- Manage User's --//
    /////////////////////////////////
    public function users()
    {
        $users = User::all();
        $roles = \Auth::user()->getRoleNames();
        return view('users.users',compact('users','roles'));
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

    //////////////////////////////////
        //-- Manage Role's --//
    /////////////////////////////////
    public function roles()
    {
        $role_permissions = Role::with('permissions')->get();
                            $permissions=Permission::pluck('name')->all();
        return view('users.roles',compact('role_permissions','permissions'));
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
        // $this->validate($request, [
        //     // 'name' => 'required',
        //     'permissions' => 'required',
        // ]);
    
        $role = Role::find($id);
        // $role->name = $request->input('name');
        // $role->save();
    
        $role->syncPermissions($request->input('permissions',[]));
        return redirect('roles')->with('success','Role updated successfully');
    }

    public function deleteRole($id)
    {
        Role::destroy($id);
        return back()->with('success', 'Role Successfully deleted.');
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

    //////////////////////////////////
        //-- Manage Permission's --//
    /////////////////////////////////
    public function permissions()
    {
        $permissions = Permission::all();
        return view('users.permissions',compact('permissions'));
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

        return redirect('permissions')->with('success','Permission updated successfully');
    }

    public function deletePermission($id)
    {
        Permission::destroy($id);
        return back()->with('success', 'Permission Successfully deleted.');
    }
}
