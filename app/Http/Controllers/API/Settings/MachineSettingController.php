<?php

namespace App\Http\Controllers\API\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Models\ManageEmployees\Machine_setting;
use Illuminate\Http\Request;

class MachineSettingController extends Controller
{
    public function index(){
        return Machine_setting::all();
    }

    public function store(Request $request){

        $data=new Machine_setting;
        $data->name = $request->name;
        $data->name_ar = $request->name_ar;
        $data->save();
    }

    public function update(Request $request,$id){

        Machine_setting::find($id)->update([
            'name' => $request->name,
            'name_ar' => $request->name_ar,
        ]);
    }

    public function show($id){
        return Machine_setting::find($id);
    }

    public function destroy($id){
        Machine_setting::find($id)->delete();
    }
}
