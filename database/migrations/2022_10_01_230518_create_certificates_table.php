<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->int('registrayion_state_id');
            $table->string('cert_id');
            $table->string('vehicle_id');
            $table->foreign('vehicle_id')->references('vehicle_id')->on('vehicles');
            $table->string('license_plate');
            $table->int('payment_status_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->unsignedBigInteger('issue_state_id');
            $table->foreign('issue_state_id')->references('id')->on('states')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('certificates');
    }
}
