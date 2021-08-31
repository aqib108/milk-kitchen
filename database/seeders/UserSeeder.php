<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'status' => '1',
            'created_at' =>\DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' =>\DB::raw('CURRENT_TIMESTAMP'),
        ]);
    }
}
