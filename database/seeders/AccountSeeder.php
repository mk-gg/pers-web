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
            'role' => 'administrator',
            'password' => Hash::make('secret'),
            'address' => 'Pasacao',
            'phone' => '0912345678',
            'birthdate' => '2021-01-01'
        ]);
    }
}
