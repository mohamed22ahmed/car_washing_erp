<?php

Route::apiResources(['userpermission' => 'API\permission\PermissionController']);
Route::apiResources(['dictionary' => 'API\DictionaryController']);

// ############################################### Finance ##############################################
//Jornals
Route::apiResources(['jornals' => 'API\Finance\JornalsController']);
Route::get('jornal_details/{id}','API\Finance\JornalsController@jornal_details');
Route::get('get_jornal_id','API\Finance\JornalsController@get_jornal_id');
Route::post('jornal_details_create','API\Finance\JornalsController@jornal_details_create');
Route::post('jornal_details_update','API\Finance\JornalsController@jornal_details_update');
Route::get('jornal_details_delete/{id}','API\Finance\JornalsController@jornal_details_delete');

//chart_of_account
Route::apiResources(['chart_of_account' => 'API\Finance\AccountChartController']);
Route::get('get_full_path','API\Finance\AccountChartController@get_full_path');


// ################################################## Employee ###########################################
//manage_emp
Route::apiResources(['manage_emp' => 'API\Employee\ManageEmployeesController']);
Route::get('get_all_employees','API\Employee\ManageEmployeesController@get_all_employees');
Route::get('show_employee/{id}','API\Employee\ManageEmployeesController@employee_show');
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
Route::get('data_show/{id}/{type}','API\Employee\Organization_structureController@data_show');
Route::get('get_month_days/{month}','API\Employee\Organization_structureController@get_month_days');
Route::get('organizational_structure_designations','API\Employee\Organization_structureController@getDesignations');
Route::get('organizational_structure_departments','API\Employee\Organization_structureController@getDepartments');
Route::get('organizational_structure_employments','API\Employee\Organization_structureController@getEmployments');
Route::delete('organizational_structure/{type}/{id}','API\Employee\Organization_structureController@destroy');
// Attendance Log Routes
Route::apiResources(['attendance_logs' => 'API\Employee\Attendance_logController']);
Route::delete('attendance_logs/{id}','API\Settings\Attendance_logController@destroy');
Route::get('session_log/{id}','API\Employee\Attendance_logController@session_log');
Route::get('emp_logs/{id}','API\Employee\Attendance_logController@emp_logs');
Route::get('sign_num/{id}','API\Employee\Attendance_logController@sign_num');
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
Route::get('leave_show/{id}','API\Settings\LeavePoliciesController@leave_show');
Route::delete('leave_policies/{id}','API\Settings\LeavePoliciesController@destroy');

// Leave Types
Route::apiResources(['leave_setups' => 'API\Settings\LeaveSetupController']);
Route::delete('leave_setups/{id}','API\Settings\LeaveSetupController@destroy');

// Leave Types
Route::apiResources(['holiday_lists' => 'API\Settings\HolidayListController']);
Route::get('get_holidays','API\Settings\HolidayListController@get_holidays');
Route::get('holiday_show/{id}','API\Settings\HolidayListController@holiday_show');
Route::delete('holiday_lists/{id}','API\Settings\HolidayListController@destroy');

// Attendance Permissions Routes
Route::apiResources(['attendance_permissions' => 'API\Employee\Attendance_permissionController']);

// Shift Management Route
Route::apiResources(['shift_management' => 'API\Employee\ShiftController']);
Route::get('get_shifts','API\Employee\ShiftController@get_shifts');
Route::get('shift_show/{id}','API\Employee\ShiftController@shift_show');
Route::delete('shift_management/{id}','API\Employee\ShiftController@destroy');


// ################################################## Washing Tickets ###########################################

// Carpet Wash Ticket
Route::apiResources(['carpet_wash' => 'API\Washing_ticket\Carpets_washingController']);
Route::get('carpet_wash_show/{id}' , 'API\Washing_ticket\Carpets_washingController@show_ticket');
Route::apiResources(['carpet_material' => 'API\Washing_ticket\Carpets_materialController']);
Route::get('carpet_washing_get_id','API\Washing_ticket\Carpets_washingController@get_id');
Route::get('carpet_washing_get_product_manages','API\Washing_ticket\Carpets_washingController@get_product_manages');
Route::get('carpet_washing_get_units/{unit_id}','API\Washing_ticket\Carpets_washingController@get_units');
Route::get('carpet_washing_get_cost/{unit_id}','API\Washing_ticket\Carpets_washingController@get_cost');
Route::get('get_carpet_serial','API\Washing_ticket\Carpets_washingController@get_serial');
Route::delete('carpet_wash/{id}','API\Washing_ticket\Carpets_washingController@destroy');
Route::delete('carpet_material/{id}','API\Washing_ticket\Carpets_materialController@destroy');
Route::get('carpet_material/{id}/{type}','API\Washing_ticket\Carpets_materialController@show');
Route::get('carpet_washing_get_total_cost/{ticket_id}','API\Washing_ticket\Carpets_washingController@get_total_cost');
Route::get('carpet_washing_get_total_discount/{ticket_id}','API\Washing_ticket\Carpets_washingController@get_total_discount');
Route::get('carpet_washing_get_total_services/{ticket_id}','API\Washing_ticket\Carpets_washingController@get_total_services');
Route::get('get_total_tickets','API\Washing_ticket\Carpets_washingController@get_total_tickets');
Route::get('carpet_washing_get_total_servs','API\Washing_ticket\Carpets_washingController@carpet_washing_get_total_servs');
Route::get('carpet_washing_get_total_cost','API\Washing_ticket\Carpets_washingController@carpet_washing_get_total_cost');
Route::get('carpet_wash/{filter}/{one}/{two}','API\Washing_ticket\Carpets_washingController@index');

// Car washing Tickets Routes
Route::apiResources(['car_washing' => 'API\Washing_ticket\Car_washingController']);
Route::get('car_wash_show/{id}' , 'API\Washing_ticket\Car_washingController@show_ticket');
Route::post('car_washing_add_code_table','API\Washing_ticket\Car_washingController@add_code_table');
Route::get('car_washing_get_id','API\Washing_ticket\Car_washingController@get_id');
Route::get('car_washing_get_product_manages','API\Washing_ticket\Car_washingController@get_product_manages');
Route::get('car_washing_get_units/{unit_id}','API\Washing_ticket\Car_washingController@get_units');
Route::get('car_washing_get_cost/{unit_id}','API\Washing_ticket\Car_washingController@get_cost');
Route::get('get_clients','API\Washing_ticket\Car_washingController@get_clients');
Route::get('get_serial','API\Washing_ticket\Car_washingController@get_serial');
Route::get('car_washing_get_total_cost/{ticket_id}','API\Washing_ticket\Car_washingController@get_total_cost');
Route::get('get_total_tickets','API\Washing_ticket\Car_washingController@get_total_tickets');
Route::get('car_washing_get_total_discount/{ticket_id}','API\Washing_ticket\Car_washingController@get_total_discount');
Route::get('car_washing_get_total_services/{ticket_id}','API\Washing_ticket\Car_washingController@get_total_services');
Route::get('car_washing_get_total_servs','API\Washing_ticket\Car_washingController@car_washing_get_total_servs');
Route::get('car_washing_get_total_cost','API\Washing_ticket\Car_washingController@car_washing_get_total_cost');
Route::get('car_washing_get_car/{number}/{letters}','API\Washing_ticket\Car_washingController@check_car_number');
Route::get('car_washing/{filter}/{one}/{two}','API\Washing_ticket\Car_washingController@index');

//Sales Report
Route::get('sales_reports/{filter}','API\Washing_ticket\SalesReportController@index');
Route::get('get_user','API\Washing_ticket\SalesReportController@get_user');
Route::get('get_total_cost/{filter}','API\Washing_ticket\SalesReportController@get_total_cost');
Route::get('get_total_tickets/{filter}','API\Washing_ticket\SalesReportController@get_total_tickets');
Route::get('get_total_servs/{filter}','API\Washing_ticket\SalesReportController@get_total_servs');
Route::get('get_total_fin_cost/{filter}','API\Washing_ticket\SalesReportController@get_total_fin_cost');


// client
Route::post('create_client','API\Washing_ticket\Car_washingController@create_client');
Route::get('get_client/{id}','API\Washing_ticket\Car_washingController@get_client');
// update Rate
Route::post('update_rate','API\Washing_ticket\Car_washingController@update_rate');
// update ticket status
Route::post('update_ticket_status','API\Washing_ticket\Car_washingController@update_ticket_status');
Route::post('update_ticket_status_carpet','API\Washing_ticket\Carpets_washingController@update_ticket_status_carpet');

// inform Admin
Route::post('informAdmin','API\Washing_ticket\Car_washingController@inform');

// ################################################## Tickets Management ###########################################





// ################################################## Store Management ###########################################
// Products Management
Route::apiResources(['products_management' => 'API\Store_manage\Products_manageController']);
Route::get('get_id','API\Store_manage\Products_manageController@getId');
Route::apiResources(['get_units' => 'API\Store_manage\Units_manageController']);
Route::apiResources(['get_services' => 'API\Store_manage\Services_manageController']);
Route::delete('products_management/{id}','API\Store_manage\Products_manageController@destroy');

// Stored Management
Route::apiResources(['stored_management' => 'API\Store_manage\Stored_manageController']);
Route::delete('stored_management/{id}','API\Store_manage\Stored_manageController@destroy');
