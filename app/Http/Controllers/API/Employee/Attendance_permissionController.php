<?php

namespace App\Http\Controllers\API\Employee;

use App\Http\Controllers\Controller;
use App\Models\ManageEmployees\Attendance_permission;
use Illuminate\Http\Request;

class Attendance_permissionController extends Controller
{
    public function index(){
        return Attendance_permission::join('employees',function($join){
            $join->on('employees.id','=','attendance_permissions.employee_id');
        })->paginate(5);
    }

    public function store(Request $request){
        $att=new Attendance_permission;
        $att->employee_id=$request->employee_id;
        $att->att_date_type=$request->att_date_type;
        $att->from_date=$request->from_date;
        $att->to_date=$request->to_date;
        $att->att_type=$request->att_type;
        $att->notes=$request->notes;
        $att->leave_type=$request->leave_type;
        $att->app_date=$request->app_date;
        $att->save();
    }

    public function update(Request $request,$id){
        $att=Attendance_permission::find($id);
        $att->employee_id=$request->employee_id;
        $att->att_date_type=$request->att_date_type;
        $att->from_date=$request->from_date;
        $att->to_date=$request->to_date;
        $att->att_type=$request->att_type;
        $att->notes=$request->notes;
        $att->leave_type=$request->leave_type;
        $att->app_date=$request->app_date;
        $att->save();
    }

    public function destroy($id){
        Attendance_permission::find($id)->delete();
    }
}
