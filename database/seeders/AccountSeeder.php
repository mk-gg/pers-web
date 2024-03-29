<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("accounts")->insert([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@pers.com',
            'account_type' => 'administrator',
            'password' => Hash::make('secret'),
            'address' => 'Pasacao',
            'mobile_no' => '0912345678',
            'birthday' => '2021-01-01',
            'status' => 'Offline'
        ]);
    }
}

