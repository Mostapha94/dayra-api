<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\User;
use App\Models\Supplier;
use Illuminate\Support\Facades\Hash;

class TestUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //admin
        $admin = new Admin();
        $admin->name = 'Dayra Admin';
        $admin->email     = "admin@dayra.com";
        $admin->password  = Hash::make('dayra5002021');
        $admin->save();

        //user
        $user = new User();
        $user->name = 'Dayra';
        $user->user_name = 'User';
        $user->email     = "user@dayra.com";
        $user->phone     = "0000000";
        $user->password  = Hash::make('dayra5002021');
        $user->save();
        $user->deposit(50000);

        //Supplier
        $supplier = new Supplier();
        $supplier->name = 'Supplier';
        $supplier->email     = "supplier@dayra.com";
        $supplier->password  = Hash::make('dayra5002021');
        $supplier->save();
    }
}
