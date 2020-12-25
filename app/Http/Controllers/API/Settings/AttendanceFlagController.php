<?php

namespace App\Http\Controllers\API\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Models\ManageEmployees\Attendance_flag;
use Illuminate\Http\Request;

class AttendanceFlagController extends Controller
{
    public function index(){
        return Attendance_flag::paginate(5);
    }

    public function store(Request $request){

        $data=new Attendance_flag;
        $data->name = $request->name;
        $data->name_ar = $request->name_ar;
        $data->colour = $request->colour;
        $data->description = $request->description;
        $data->status = $request->status;
        $data->shift = $request->shift;
        $data->save();
    }

    public function update(Request $request,$id){

        Attendance_flag::find($id)->update([
            'name' => $request->name,
            'name_ar' => $request->name_ar,
            'colour' => $request->colour,
            'description' => $request->description,
            'status' => $request->status,
            'shift' => $request->shift,
        ]);
    }

    public function show($id){
        return Attendance_flag::find($id);
    }

    public function destroy($id){
        Attendance_flag::find($id)->delete();
    }
}
