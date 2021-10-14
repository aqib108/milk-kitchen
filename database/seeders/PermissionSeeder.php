<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use DB;
class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = [
            [
                'id'    => 1,
                'name' => 'add Warehouse',
                'guard_name' => 'web',
                'created_at' =>DB::raw('CURRENT_TIMESTAMP'),
                'updated_at' =>DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'id'    => 2,
                'name' => 'edit Warehouse',
                'guard_name' => 'web',
                'created_at' =>DB::raw('CURRENT_TIMESTAMP'),
                'updated_at' =>DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'id'    => 3,
                'name' => 'manage Warehouse',
                'guard_name' => 'web',
                'created_at' =>DB::raw('CURRENT_TIMESTAMP'),
                'updated_at' =>DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'id'    => 4,
                'name' => 'manage users',
                'guard_name' => 'web',
                'created_at' =>DB::raw('CURRENT_TIMESTAMP'),
                'updated_at' =>DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'id'    => 5,
                'name' => 'manage customers',
                'guard_name' => 'web',
                'created_at' =>\DB::raw('CURRENT_TIMESTAMP'),
                'updated_at' =>\DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'id'    => 6,
                'name' => 'manage sales',
                'guard_name' => 'web',
                'created_at' =>\DB::raw('CURRENT_TIMESTAMP'),
                'updated_at' =>\DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'id'    => 7,
                'name' => 'manage reports',
                'guard_name' => 'web',
                'created_at' =>\DB::raw('CURRENT_TIMESTAMP'),
                'updated_at' =>\DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'id'    => 8,
                'name' => 'check Deliveries Record',
                'guard_name' => 'web',
                'created_at' =>\DB::raw('CURRENT_TIMESTAMP'),
                'updated_at' =>\DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'id'    => 9,
                'name' => 'manage dashboard',
                'guard_name' => 'web',
                'created_at' =>\DB::raw('CURRENT_TIMESTAMP'),
                'updated_at' =>\DB::raw('CURRENT_TIMESTAMP'),
            ],
        ];
        Permission::insert($permission);  
    }
}
