<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operations', function (Blueprint $table) {
            $table->increments('operation_id')->unique();
            $table->string('incident_id');
            $table->string('unit_name')->nullable();
            $table->string('dispatcher_id');
            $table->string('external_agency_id')->nullable();
            $table->string('etd_base')->nullable();
            $table->string('eta_scene')->nullable();
            $table->string('eta_hospital')->nullable();
            $table->string('etd_hospital')->nullable();
            $table->string('eta_base')->nullable();
            $table->string('receiving_facility')->nullable();
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
        Schema::dropIfExists('operations');
    }
}
