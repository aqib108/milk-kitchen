<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Traits\HasRoles;
class UserSeeder extends Seeder
{
    use HasRoles;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('demoadmin'),
            'status' => '1',
        ]);
        $user->syncRoles('Admin');
        $user = User::create([
            'name' => 'Customer',
            'email' => 'user@gmail.com',
            'password' => bcrypt('demouser'),
            'status' => '1',
        ]);
        return $user->syncRoles('Customer');
    }
}
