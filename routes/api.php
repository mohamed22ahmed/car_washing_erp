<?php

Route::apiResources(['userpermission' => 'API\permission\PermissionController']);
Route::apiResources(['dictionary' => 'API\DictionaryController']);

// ############################################### Finance ##############################################
//Jornals
Route::apiResources(['jornals' => 'API\Finance\FinanceController']);
//chart_of_account
Route::apiResources(['chart_of_account' => 'API\Finance\AccountChartController']);


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

// Attendance Flag
Route::apiResources(['attendance_flags' => 'API\Settings\AttendanceFlagController']);
Route::delete('attendance_flags/{id}','API\Settings\AttendanceFlagController@destroy');

// Machine Settings
Route::apiResources(['machine_settings' => 'API\Settings\MachineSettingController']);
Route::delete('machine_settings/{id}','API\Settings\MachineSettingController@destroy');

// Leave Policies
Route::apiResources(['leave_policies' => 'API\Settings\LeavePoliciesController']);
Route::get('get_leaves','API\Settings\LeavePoliciesController@get_leaves');
Route::delete('leave_policies/{id}','API\Settings\LeavePoliciesController@destroy');

// Leave Types
Route::apiResources(['leave_setups' => 'API\Settings\LeaveSetupController']);
Route::delete('leave_setups/{id}','API\Settings\LeaveSetupController@destroy');

// Leave Types
Route::apiResources(['holiday_lists' => 'API\Settings\HolidayListController']);
Route::delete('holiday_lists/{id}','API\Settings\HolidayListController@destroy');

// Attendance Permissions Routes
Route::apiResources(['attendance_permissions' => 'API\Employee\Attendance_permissionController']);

// Shift Management Route
Route::apiResources(['shift_management' => 'API\Employee\ShiftController']);


// ################################################## Washing Tickets ###########################################






// ################################################## Tickets Management ###########################################
