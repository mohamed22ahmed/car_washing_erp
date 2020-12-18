<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManageEmployeesRolesController extends Controller
{
    public function index(){
        return view('admin.dept_of_hr.manage_employees_roles.index');
    }

    public function create(){
        return view('admin.dept_of_hr.manage_employees_roles.create');
    }

    public function store(Request $request){
        return redirect()->route('manage_employees_roles.index');
    }

    // public function edit(){
    //     return view('admin.dept_of_hr.manage_employees_roles.edit');
    // }

    // public function update(Request $request){
    //     return redirect()->route('manage_employees_roles.index');
    // }

    public function show(){
        return view('admin.dept_of_hr.manage_employees_roles.show');
    }

}
