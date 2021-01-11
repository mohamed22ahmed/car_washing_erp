<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('sir_name')->nullable();
            $table->string('last_name');
            $table->string('fist_name_en');
            $table->string('sir_name_en')->nullable();
            $table->string('last_name_en');
            $table->string('name');
            $table->string('name_en');
            $table->string('emp_picture')->nullable();
            $table->string('notes')->nullable();
            $table->string('email');
            $table->integer('status');
            $table->integer('send_credentials')->nullable();
            $table->integer('allow_access')->nullable();
            $table->integer('language');
            $table->integer('role');
            $table->date('date_of_birth');
            $table->integer('gender')->nullable();
            $table->integer('country');
            $table->string('mobile_number')->nullable();
            $table->string('present_address')->nullable();
            $table->integer('present_city')->nullable();
            $table->integer('present_state')->nullable();
            $table->string('perm_address')->nullable();
            $table->integer('perm_city')->nullable();
            $table->integer('perm_state')->nullable();
            $table->integer('designation')->nullable();
            $table->integer('department')->nullable();
            $table->integer('emp_level')->nullable();
            $table->date('join_date');
            $table->integer('branch');
            $table->integer('salary');
            $table->integer('attendance_shift')->nullable();
            $table->integer('leave_policy')->nullable();
            $table->integer('holiday_lists')->nullable();
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
        Schema::dropIfExists('employees');
    }
}
