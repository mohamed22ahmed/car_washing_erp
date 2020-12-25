<?php

namespace App\Http\Controllers\API\Employee;

use App\Http\Controllers\Controller;
use App\Models\ManageEmployees\Department;
use App\Models\ManageEmployees\Designation;
use App\Models\ManageEmployees\Employee;
use Illuminate\Http\Request;

class Organization_structureController extends Controller
{
    public function getDesignations(){
        return Designation::where('type',1)->get();
    }

    public function getDepartments(){
        return Department::all();
    }

    public function getEmployments(){
        return Designation::where('type',2)->get();
    }

    public function getEmployees(){
        return Employee::all();
    }

    public function get_month_days($month){
        $year=date("Y");
        if($month==2&&$year%4==0&&$year%100!=0)
            return 29;
        else if($month==2)
            return 28;
        else if($month==1||$month==3||$month==5||$month==7||$month==8||$month==10||$month==12)
            return 31;
        return 30;
    }

    public function store(Request $request){
        if($request->addNewValue==1){
            Designation::create([
                'name'=>$request->name,
                'name_ar'=>$request->name_ar,
                'status'=>$request->status,
                'description'=>$request->description,
                'type'=>1
            ]);
        }else if($request->addNewValue==2){
            Department::create([
                'name'=>$request->name,
                'name_ar'=>$request->name_ar,
                'abbreviation'=>$request->abbreviation,
                'status'=>$request->status,
                'description'=>$request->description,
                'employee_id'=>$request->employee_id,
                'month'=>$request->month,
                'day'=>$request->day
            ]);
        }else{
            Designation::create([
                'name'=>$request->name,
                'name_ar'=>$request->name_ar,
                'status'=>$request->status,
                'description'=>$request->description,
                'type'=>2
            ]);
        }
    }

    public function update(Request $request,$id){
        if($request->addNewValue==1){
            Designation::where('id',$request->id)->update([
                'name'=>$request->name,
                'name_ar'=>$request->name_ar,
                'status'=>$request->status,
                'description'=>$request->description,
            ]);
        }else if($request->addNewValue==2){
            Department::where('id',$request->id)->update([
                'name'=>$request->name,
                'name_ar'=>$request->name_ar,
                'abbreviation'=>$request->abbreviation,
                'status'=>$request->status,
                'description'=>$request->description,
                'employee_id'=>$request->employee_id,
                'month'=>$request->month,
                'day'=>$request->day
            ]);
        }else{
            Designation::where('id',$request->id)->update([
                'name'=>$request->name,
                'name_ar'=>$request->name_ar,
                'status'=>$request->status,
                'description'=>$request->description,
            ]);
        }
    }

    public function destroy($type,$id){
        if($type==2)
            Department::find($id)->delete();
        else
            Designation::find($id)->delete();
    }
}
