<?php

namespace App\Http\Controllers\API\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Models\ManageEmployees\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;

class ManageEmployeesController extends Controller
{
    public function index(){
        return Employee::paginate(5);
    }

    public function store(EmployeeRequest $request){
        $fileNewName='';
        if($request->emp_picture){
            $fileNewName="employee_".time().".jpg";
            $path='storage/employees/';
            Image::make($request->emp_picture)->save($path.$fileNewName);
        }

        $this->saveData($request,$fileNewName);
    }

    public function saveData($request,$fileNewName){
        if($request->id!=null)
            $emp=Employee::find($request->id);
        else
            $emp=new Employee;

        $emp->first_name=$request->first_name;
        $emp->sir_name=$request->sir_name;
        $emp->last_name=$request->last_name;
        $emp->emp_picture=$fileNewName;
        $emp->notes=$request->notes;
        $emp->email=$request->email;
        $emp->status=$request->status;
        $emp->send_credentials=$request->send_credentials;
        $emp->allow_access=$request->allow_access;
        $emp->language=$request->language;
        $emp->role=$request->role;
        $emp->date_of_birth=$request->date_of_birth;
        $emp->gender=$request->gender;
        $emp->country=$request->country;
        $emp->mobile_number=$request->mobile_number;
        $emp->present_address=$request->present_address;
        $emp->present_city=$request->present_city;
        $emp->present_state=$request->present_state;
        $emp->perm_address=$request->perm_address;
        $emp->perm_city=$request->perm_city;
        $emp->perm_state=$request->perm_state;
        $emp->designation=$request->designation;
        $emp->department=$request->department;
        $emp->emp_level=$request->emp_level;
        $emp->join_date=$request->join_date;
        $emp->branch=$request->branch;
        $emp->attendance_shift=$request->attendance_shift;
        $emp->leave_policy=$request->leave_policy;
        $emp->holiday_lists=$request->holiday_lists;
        $emp->save();

    }

    public function show($id){
        return Employee::find($id);
    }

    public function destroy($id){
        Employee::find($id)->delete();
    }
}