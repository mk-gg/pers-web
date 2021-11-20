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
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('sex');
            $table->string('age')->nullable();
            $table->string('description');
            $table->string('location');
            $table->timestamp('date_time_reported');
            $table->string('location_id')->nullable();
            $table->string('account_id')->nullable();
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
