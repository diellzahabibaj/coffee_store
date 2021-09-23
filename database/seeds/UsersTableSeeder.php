<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Role;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        //DB::table('role_user')->truncate();

        $adminRole = User::where('role', 'admin')->get();
        //$customerRole = User::where('role', 'customer')->get();

        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'Admin@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('admin1234')
        ]);

        /*$customer = User::create([
            'role' => 'Customer User',
            'email' => 'Customer@gmail.com',
            'password' => Hash::make('customer')
        ]);*/

        //$admin->roles()->attach($adminRole);
        //$customer->roles()->attach($customerRole);
    }
}
