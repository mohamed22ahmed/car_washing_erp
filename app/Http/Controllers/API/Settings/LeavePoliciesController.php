<?php

namespace App\Http\Controllers\API\Settings;

use App\Http\Controllers\Controller;
use App\Models\ManageEmployees\Leave_policy;
use Illuminate\Http\Request;

class LeavePoliciesController extends Controller
{
    public function index(){
        return Leave_policy::all();
    }

    public function store(Request $request){

        $data=new Leave_policy;
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

        Leave_policy::find($id)->update([
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
        return Leave_policy::find($id);
    }

    public function destroy($id){
        Leave_policy::find($id)->delete();
    }
}
