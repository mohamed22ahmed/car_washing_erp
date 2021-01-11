<?php

namespace App\Http\Controllers\API\Washing_ticket;

use App\Http\Controllers\Controller;
use App\Models\code_table;
use App\Models\Store_manage\Custom_unit;
use App\Models\Store_manage\Product_manage;
use App\Models\Store_manage\Service;
use App\Models\Washing_tickets\Car;
use App\Models\Washing_tickets\Car_washing;
use Illuminate\Http\Request;

class Car_washingController extends Controller
{
    public function check_car_number($number,$letters){

        if(strlen($number)!=3)
            return 'num_error';
        if(strlen($letters)>4){
            return 'letter_error';
        }
        $car=Car::where(['car_number'=>$number,'car_letters'=>$letters])->first();
        return $car??'';
    }

    public function get_total_services($ticket_id){
        return Service::where(['ticket_id'=>$ticket_id,'type'=>1])->count();
    }

    public function get_total_cost($ticket_id){
        return Service::where(['ticket_id'=>$ticket_id,'type'=>1])->sum('cost')+Service::where(['ticket_id'=>$ticket_id,'type'=>1])->sum('extra_cost');
    }

    public function get_id(){
        return Car_washing::max('id')+1;
    }

    public function get_product_manages(){
        return Product_manage::where('classifications',1)->get();
    }

    public function get_units($product_id){
        return Custom_unit::where('product_id',$product_id)->get();
    }

    public function get_cost($unit_id){
        $unit=Custom_unit::where('id',$unit_id)->first();
        return $unit->cost;
    }

    public function index(){
        $cars=Car_washing::all();
        $services=Service::where('type',1)->get();
        foreach($services as $ser){
            $x=1;
            foreach($cars as $car){
                if($ser->ticket_id==$car->id){
                    $x=2;
                    break;
                }
            }
            if($x==1)
                $ser->delete();
        }
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
        $car_wash->num_of_materials=$request->total_services;
        $car_wash->total_price=$request->total_cost;
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
        $car_wash->num_of_materials=$request->total_services;
        $car_wash->total_price=$request->total_cost;
        $car_wash->save();
        return response(['success','your data Updated successfully'],200);
    }

    public function destroy($id){
        Service::where(['ticket_id'=>$id,'type'=>1])->delete();
        Car_washing::find($id)->delete();
        return response(['success','your data deleted successfully'],200);
    }

    public function show_ticket($id){
        return Car_washing::find($id);
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
        $serial=Car_washing::max('id')+1;
        $ser=0;
        if($serial<=9)
            $ser=' 000'.$serial;
        else if($serial<=99)
            $ser=' 00'.$serial;
        else if($serial<=999)
            $ser=' 0'.$serial;
        else
            $ser=' '.$serial;
        $serial=date('Y').' 0110'.$ser;
        return $serial;
    }
}
