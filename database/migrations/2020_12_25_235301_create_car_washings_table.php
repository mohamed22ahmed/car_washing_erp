<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarWashingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_washings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('serial_number');
            $table->date('ticket_date');
            $table->integer('wash');
            $table->integer('ticket_status');
            $table->string('car_number_num_en')->nullable();
            $table->string('car_number_letters_en')->nullable();
            $table->string('car_number_num_ar');
            $table->string('car_number_letters_ar');

            $table->integer('color');
            $table->integer('brand');
            $table->integer('car_status');
            $table->integer('client');
            $table->string('client_status');
            $table->string('phone');
            $table->date('enterance_date');
            $table->date('exit_expected_date');
            $table->integer('total_price')->nullable();
            $table->integer('num_of_materials')->nullable();
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
        Schema::dropIfExists('car_washings');
    }
}
