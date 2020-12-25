<?php

Route::apiResources(['userpermission' => 'API\permission\PermissionController']);
Route::apiResources(['dictionary' => 'API\DictionaryController']);

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
// organizational structure Routes
Route::apiResources(['organizational_structure' => 'API\Employee\Organization_structureController']);
Route::get('get_employees','API\Employee\Organization_structureController@getEmployees');
Route::get('get_month_days/{month}','API\Employee\Organization_structureController@get_month_days');
Route::get('organizational_structure_designations','API\Employee\Organization_structureController@getDesignations');
Route::get('organizational_structure_departments','API\Employee\Organization_structureController@getDepartments');
Route::get('organizational_structure_employments','API\Employee\Organization_structureController@getEmployments');
Route::delete('organizational_structure/{type}/{id}','API\Employee\Organization_structureController@destroy');
// Attendance Log Routes
Route::apiResources(['attendance_logs' => 'API\Employee\Attendance_logController']);
Route::get('pull_machine','API\Employee\Attendance_logController@machine_pull');
Route::get('attendance_file','API\Employee\Attendance_logController@upload_attendance');
// Attendance Permissions Routes
Route::apiResources(['attendance_permissions' => 'API\Employee\Attendance_permissionController']);
// Shift Management Route
Route::apiResources(['shift_management' => 'API\Employee\ShiftController']);
