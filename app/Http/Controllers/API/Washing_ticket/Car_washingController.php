<?php

namespace App\Http\Controllers\API\Washing_ticket;

use App\Http\Controllers\Controller;
use App\Models\code_table;
use App\Models\Washing_tickets\Car_washing;
use Illuminate\Http\Request;

class Car_washingController extends Controller
{
    public function index(){
        return Car_washing::paginate(5);
    }

    public function store(Request $request){
        $car_wash=new Car_washing;
        $car_wash->serial_number=$request->serial_number;
        $car_wash->ticket_date=$request->ticket_date;
        $car_wash->wash=$request->wash;
        $car_wash->ticket_status=$request->ticket_status;
        $car_wash->car_number_num_ar=$request->car_number_num_ar;
        $car_wash->car_number_letters_ar=$request->car_number_letters_ar;
        $car_wash->car_number_num_en=$request->car_number_num_en ;
        $car_wash->car_number_letters_en=$request->car_number_letters_en;
        $car_wash->color=$request->color;
        $car_wash->brand=$request->brand;
        $car_wash->car_status=$request->car_status;
        $car_wash->client=$request->client;
        $car_wash->client_status=$request->client_status;
        $car_wash->phone=$request->phone;
        $car_wash->enterance_date=$request->enterance_date;
        $car_wash->exit_expected_date=$request->exit_expected_date;
        $car_wash->save();
        return response(['success','your data created successfully'],200);
    }

    public function update(Request $request,$id){
        $car_wash=Car_washing::find($id);
        $car_wash->ticket_date=$request->ticket_date;
        $car_wash->wash=$request->wash;
        $car_wash->ticket_status=$request->ticket_status;
        $car_wash->car_number_num_ar=$request->car_number_num_ar;
        $car_wash->car_number_letters_ar=$request->car_number_letters_ar;
        $car_wash->car_number_num_en=$request->car_number_num_en ;
        $car_wash->car_number_letters_en=$request->car_number_letters_en;
        $car_wash->color=$request->color;
        $car_wash->brand=$request->brand;
        $car_wash->car_status=$request->car_status;
        $car_wash->client=$request->client;
        $car_wash->client_status=$request->client_status;
        $car_wash->phone=$request->phone;
        $car_wash->enterance_date=$request->enterance_date;
        $car_wash->exit_expected_date=$request->exit_expected_date;
        $car_wash->save();
        return response(['success','your data Updated successfully'],200);
    }

    public function destroy($id){
        $data=Car_washing::find($id)->delete();
        return response(['success','your data deleted successfully'],200);
    }

    public function add_code_table(Request $request){
        $sys_code=code_table::where('sys_code_type',$request->sys_code_type)->max('sys_code')+1;
        code_table::create([
            'sys_code_type'=>$request->sys_code_type,
            'sys_code'=>$sys_code,
            'name'=>$request->name,
            'name_ar'=>$request->name_ar
        ]);
    }

    public function show($id){
        return code_table::where('sys_code_type',$id)->get();
    }

    public function get_clients(){
        return 0;
        return Client::all();
    }

    public function get_serial(){
        $serial=Car_washing::max('serial_number')+1;
        $ser=0;
        if($serial<=9)
            $ser=' 000'.$serial;
        else if($serial<=99)
            $ser=' 00'.$serial;
        else if($serial<=999)
            $ser=' 0'.$serial;
        else
            $ser=' '.$serial;
        $serial=date('Y').' 0000'.$ser;
        return $serial;
    }
}
