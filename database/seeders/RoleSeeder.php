<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'id'    => 1,
                'name' => 'Admin',
                'guard_name' => 'web',
                'created_at' =>\DB::raw('CURRENT_TIMESTAMP'),
                'updated_at' =>\DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'id'    => 2,
                'name' => 'Sales Member',
                'guard_name' => 'web',
                'created_at' =>\DB::raw('CURRENT_TIMESTAMP'),
                'updated_at' =>\DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'id'    => 3,
                'name' => 'Site Employee',
                'guard_name' => 'web',
                'created_at' =>\DB::raw('CURRENT_TIMESTAMP'),
                'updated_at' =>\DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'id'    => 4,
                'name' => 'Warehouse',
                'guard_name' => 'web',
                'created_at' =>\DB::raw('CURRENT_TIMESTAMP'),
                'updated_at' =>\DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'id'    => 5,
                'name' => 'Driver',
                'guard_name' => 'web',
                'created_at' =>\DB::raw('CURRENT_TIMESTAMP'),
                'updated_at' =>\DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'id'    => 6,
                'name' => 'Customer',
                'guard_name' => 'web',
                'created_at' =>\DB::raw('CURRENT_TIMESTAMP'),
                'updated_at' =>\DB::raw('CURRENT_TIMESTAMP'),
            ],
        ];
        Role::insert($roles);   
    }
}
