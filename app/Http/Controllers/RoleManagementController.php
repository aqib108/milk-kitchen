<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;
use Auth;
use App\Models\User;

class RoleManagementController extends Controller
{
    //
    use HasRoles;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $role = Role::create(['name' => 'Admin']);
        $role = Role::create(['name' => 'Sales Member']);
        $role = Role::create(['name' => 'Site Employee']);
        $role = Role::create(['name' => 'Distributor']);
        $role = Role::create(['name' => 'Driver']);
        $role = Role::create(['name' => 'Customer']);
    }

    public function permission()
    {
        $role = Role::create(['name' => 'Admin']);
        $role = Role::create(['name' => 'Sales Member']);
        $permission = Permission::create(['name' => 'administrator_create']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'administrator_show']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'administrator_edit']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'administrator_delete']);
        $role->givePermissionTo($permission);

        $role = Role::create(['name' => 'Manager']);
        $permission = Permission::create(['name' => 'manager_create']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'manager_edit']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'manager_show']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'manager_delete']);
        $role->givePermissionTo($permission);

        $role = Role::create(['name' => 'Accounting']);
        $permission = Permission::create(['name' => 'account_create']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'account_show']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'account_edit']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'account_delete']);
        $role->givePermissionTo($permission);

        $role = Role::create(['name' => 'Editor']);
        $permission = Permission::create(['name' => 'editor_create']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'editor_show']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'editor_edit']);
        $role->givePermissionTo($permission);
        $permission = Permission::create(['name' => 'editor_delete']);
        $role->givePermissionTo($permission);


    }
    public function assign()
    {
        $id = Auth::user()->id;
        $user = User::with('roles')->with('permissions')->find($id);
        $role = Role::all();
        dd($user->syncRoles('Super Admin'));
    }
}
