<?php

namespace App\Http\Controllers\API\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Models\ManageEmployees\Leave_policy;
use App\Models\ManageEmployees\Leave_Setup;
use Illuminate\Http\Request;

class LeavePoliciesController extends Controller
{
    public function index(){
        return Leave_policy::all();
    }

    public function get_leaves(){
        return Leave_Setup::all();
    }

    public function store(Request $request){

        $data=new Leave_policy;
        $data->name = $request->name;
        $data->name_ar = $request->name_ar;
        $data->leave_type = $request->leave_type;
        $data->description = $request->description;
        $data->status = $request->status;
        $data->save();
    }

    public function update(Request $request,$id){

        Leave_policy::find($id)->update([
            'name' => $request->name,
            'name_ar' => $request->name_ar,
            'leave_type' => $request->leave_type,
            'description' => $request->description,
            'status' => $request->status,
        ]);
    }

    public function show($id){
        return Leave_policy::find($id);
    }

    public function destroy($id){
        Leave_policy::find($id)->delete();
    }
}
