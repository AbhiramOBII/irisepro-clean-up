<?php

use Illuminate\Database\Seeder;
use App\SuperAdmin;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SuperAdmin::create([
            'superadmin_fullname' => 'Super Administrator',
            'superadmin_email' => 'admin@irisepro.in',
            'password' => Hash::make('KillBill123#@!'),
            'status' => 'active'
        ]);
    }
}
