<?php
namespace Database\Seeders;

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
        SuperAdmin::updateOrCreate([
            'superadmin_fullname' => 'Super Administrator',
            'superadmin_email' => 'admin@irisepro.in',
            'password' => Hash::make('KillBill123#@!'),
            'status' => 'active'
        ], [
            'superadmin_fullname' => 'Super Administrator',
            'superadmin_email' => 'admin@irisepro.in',
            'password' => Hash::make('KillBill123#@!'),
            'status' => 'active'
        ]);
    }
}
