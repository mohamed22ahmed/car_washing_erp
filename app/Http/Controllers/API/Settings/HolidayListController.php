<?php

namespace App\Http\Controllers\API\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Models\ManageEmployees\Holiday_list;
use Illuminate\Http\Request;

class HolidayListController extends Controller
{
    public function index(){
        return Holiday_list::paginate(5);
    }

    public function get_leaves(){
        return Holiday_list::all();
    }

    public function store(Request $request){

        $data=new Holiday_list;
        $data->name = $request->name;
        $data->name_ar = $request->name_ar;
        $data->start_date = $request->start_date;
        $data->end_date = $request->end_date;
        $data->save();
    }

    public function update(Request $request,$id){

        Holiday_list::find($id)->update([
            'name' => $request->name,
            'name_ar' => $request->name_ar,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);
    }

    public function show($id){
        return Holiday_list::find($id);
    }

    public function destroy($id){
        Holiday_list::find($id)->delete();
    }
}
