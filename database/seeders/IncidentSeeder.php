<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class IncidentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("incidents")->insert([
            'first_name' => 'Juanito',
            'last_name' => 'Panito',
            'sex' => 'male',
            'age' => '53',
            'incident_type' => 'Heat Stroke',
            'description' => 'Man got heatstroke',
            'location' => 'Pascao',
            'status' => 'Pending'
        ]);
    }
}
