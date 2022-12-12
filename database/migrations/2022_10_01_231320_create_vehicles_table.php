<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('vehicle_id');
            $table->integer('vin')->unique;
            $table->string('certificate_id');
            $table->string('owner_voms_id');
            $table->string('dealer_voms_id');
            $table->string('colour', 100);
            $table->string('manufacturer', 100);
            $table->integer('year');
            $table->unsignedBigInteger('registration_state_id');
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
        Schema::dropIfExists('vehicles');
    }
}
