<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->bigInteger('id')->default(0);
            $table->bigInteger('parent_id');
            $table->bigInteger('user_id');
            $table->string('name');
            $table->string('name_ar');
            $table->string('account_type')->nullable();
            $table->string('balance_type')->nullable();
            $table->string('final_account')->nullable();
            $table->integer('value_in')->nullable();
            $table->integer('value_out')->nullable();
            $table->integer('balance')->nullable();
            $table->string('accountable_type')->nullable();
            $table->integer('accountable_id')->nullable();
            $table->integer('Column10')->nullable();
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
        Schema::dropIfExists('accounts');
    }
}
