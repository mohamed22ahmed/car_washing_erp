<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionTables extends Migration
{

    public function up()
    {
        Schema::create('screens', function (Blueprint $table) {
            $table->string('screen_route');
            $table->string('operation_type');
            $table->integer('module_id');
            $table->string('module_name');
            $table->string('screen_name');
            $table->integer('sort');
            $table->primary(['screen_route']);
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('name_ar');
            $table->timestamps();
        });

        Schema::create('role_has_permissions', function (Blueprint $table){
            $table->string('screen_route');
            $table->tinyinteger('operation_id');
            $table->smallInteger('role_id');
            $table->primary(['screen_route','operation_id', 'role_id'], 'role_has_permissions_primary');
        });
    }


    public function down()
    {
        $tableNames = config('permission.table_names');

        if (empty($tableNames)) {
            throw new \Exception('Error: config/permission.php not found and defaults could not be merged. Please publish the package configuration before proceeding, or drop the tables manually.');
        }

        Schema::drop($tableNames['screens']);
        Schema::drop($tableNames['role_has_permissions']);
        Schema::drop($tableNames['user_has_roles']);
        Schema::drop($tableNames['roles']);
    }
}
