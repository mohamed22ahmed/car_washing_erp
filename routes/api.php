<?php

Route::apiResources(['userpermission' => 'API\permission\PermissionController']);

// ############################################### Finance ##############################################
//Jornals
Route::apiResources(['jornals' => 'API\Dashboard\FinanceController']);
//chart_of_account
Route::apiResources(['chart_of_account' => 'API\Dashboard\AccountChartController']);


// ################################################## Employee ###########################################
//manage_emp
Route::apiResources(['manage_emp' => 'API\Employee\ManageEmployeesController']);
Route::get('manage_emp_delete/{id}','API\Employee\ManageEmployeesController@destroy');
//roles
Route::apiResources(['roles' => 'API\Employee\RoleController']);
//permissions
Route::apiResources(['permission' => 'API\Employee\PermissionController']);
Route::get('permission_roles','API\Employee\PermissionController@get_roles');
Route::get('permission_modules','API\Employee\PermissionController@get_modules');
Route::get('permissions_pages/{role}/{module}','API\Employee\PermissionController@get_pages');

