<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarpetWashingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carpet_washings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('ticket_date');
            $table->integer('wash')->default(-1);
            $table->integer('ticket_status')->default(-1);
            $table->integer('client')->default(-1);
            $table->string('phone_number')->nullable();
            $table->integer('carpet_size')->default(-1);
            $table->integer('wash_type')->default(-1);
            $table->date('receipt_date');
            $table->date('expected_exit_date');
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
        Schema::dropIfExists('carpet_washings');
    }
}
