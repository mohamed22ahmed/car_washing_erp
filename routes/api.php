<?php

Route::apiResources(['tag_setup' => 'API\tag_setupController']);

//Jornals
Route::apiResources(['jornals' => 'API\Dashboard\FinanceController']);

//manage_role
Route::apiResources(['manage_role' => 'API\Dashboard\ManageEmployeesRolesController']);

//manage_emp
Route::apiResources(['manage_emp' => 'API\Dashboard\ManageEmployeesController']);

//chart_of_account
Route::apiResources(['chart_of_account' => 'API\Dashboard\AccountChartController']);


