<?php

namespace App\Http\Controllers\API\Employee;

use App\Http\Controllers\Controller;
use App\Models\ManageEmployees\Attendance_log;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon;
use DB;

class Attendance_logController extends Controller
{
    public function index(){
        $data = DB::table('attendance_logs')
        ->join('employees','employees.id','=','attendance_logs.employee_name')
        ->select('attendance_logs.*','employees.name as employee_name')
        ->paginate(5);
        return $data;
    }

    public function session_log($id){
        return Attendance_log::where('id',$id)->first();
    }

    public function emp_logs($id){
        $data = DB::table('attendance_logs')
        ->join('employees','employees.id','=','attendance_logs.employee_name')
        ->select('attendance_logs.*','employees.name as employee_name')
        ->where('employees.id','=',$id)
        ->get();
        return $data;
    }

    public function sign_num($id){
        $user=DB::table('attendance_logs')->where('id',$id)->pluck('employee_name')->first();
        return Attendance_log::where('employee_name',$user)->count();
    }

    public function machine_pull(){
        dd('pull from machine');
    }

    public function store(Request $request){

        $session_num=Attendance_log::max('session_num')+1;
        $user=DB::table('users')->pluck('name')->first();
        $log=new Attendance_log;
        $log->employee_name=$request->employee;
        $log->session_num=$session_num;
        $log->source_type=$user;
        $log->status=1;
        $log->save();
        return $log;
    }

    public function destroy($id){
        Attendance_log::find($id)->delete();
    }
}
