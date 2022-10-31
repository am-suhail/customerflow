<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
            'name' => 'Super Admin',
            'mobile' => '506517567',
            'email' => 'admin@ditllc.com',
            'password' => Hash::make('Admind1t-7139'),
            'profile' => 'super_admin',
            'profile_completed' => true
        ]);
    }
}
