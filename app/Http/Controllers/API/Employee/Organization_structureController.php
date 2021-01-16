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
        $design=Designation::where('type',1)->get();
        if(session('lang')=='ar')
            foreach($design as $des){
                $des->name=$des->name_ar;
            }
        return $design;
    }

    public function getDepartments(){
        $depts=Department::all();
        if(session('lang')=='ar')
            foreach($depts as $dept){
                $dept->name=$dept->name_ar;
            }
        return $depts;
    }

    public function getEmployments(){
        $emp_levs=Designation::where('type',2)->get();
        if(session('lang')=='ar')
            foreach($emp_levs as $emp_lev){
                $emp_lev->name=$emp_lev->name_ar;
            }
        return $emp_levs;
    }

    public function getEmployees(){
        $emps= Employee::all();
            foreach($emps as $emp){
                if(session('lang')=='ar')
                    $emp->name_en=$emp->name;
                else
                    $emp->name=$emp->name_en;
            }
        return $emps;
    }

    public function data_show($id,$type){
        if($type==2)
            return Department::find($id);
        else
            return Designation::find($id);
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
