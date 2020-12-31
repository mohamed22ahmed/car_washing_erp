<?php

namespace App\Http\Controllers\API\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Models\ManageEmployees\Leave_Setup;
use Illuminate\Http\Request;

class LeaveSetupController extends Controller
{
    public function index(){
        return Leave_Setup::all();
    }

    public function store(Request $request){

        $data=new Leave_Setup;
        $data->name = $request->name;
        $data->name_ar = $request->name_ar;
        $data->colour = $request->colour;
        $data->description = $request->description;
        $data->max_days = $request->max_days;
        $data->max_applicable_days = $request->max_applicable_days;
        $data->applicable_after = $request->applicable_after;
        $data->save();
    }

    public function update(Request $request,$id){

        Leave_Setup::find($id)->update([
            'name' => $request->name,
            'name_ar' => $request->name_ar,
            'colour' => $request->colour,
            'description' => $request->description,
            'max_days' => $request->max_days,
            'max_applicable_days' => $request->max_applicable_days,
            'applicable_after' => $request->applicable_after,
        ]);
    }

    public function show($id){
        return Leave_Setup::find($id);
    }

    public function destroy($id){
        Leave_Setup::find($id)->delete();
    }
}
