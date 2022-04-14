<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncidentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('incidents', function (Blueprint $table) {
            $table->increments('incident_id')->unique();
            $table->string('incident_type');
            $table->string('name')->nullable();
            $table->string('sex')->nullable();
            $table->string('age')->nullable();
            $table->string('description')->nullable();
            $table->string('location_id')->nullable();
            $table->string('account_id')->nullable();
            $table->string('incident_status');
            $table->string('victim_status');
            $table->string('permanent_address')->nullable();
            $table->string('temperature')->nullable();
            $table->string('pulse_rate')->nullable();
            $table->string('respiration_rate')->nullable();
            $table->string('blood_pressure')->nullable();

            $table->rememberToken()->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('incidents');
    }
}
