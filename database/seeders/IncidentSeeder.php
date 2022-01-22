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
            'name' => 'Juanito Panits',
            'sex' => 'male',
            'age' => '53',
            'incident_type' => 'Heat Stroke',
            'description' => 'Man got heatstroke',
            'location' => 'Pascao',
            'incident_status' => 'Pending',
            'victim_status' => 'Critical'
        ]);
    }
}
