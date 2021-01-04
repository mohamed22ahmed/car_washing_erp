<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCodeTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('code_tables', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->smallInteger('sys_code_type');
        $table->smallInteger('sys_code');
        $table->smallInteger('parent_code')->default(1);
        $table->string('name',100);
        $table->string('name_ar',100);
        $table->timestamps();
        $table->primary(['sys_code_type','sys_code']);
    });

    }

    /**
     * Reverse the migrations.

     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('code_tables');
    }
}
