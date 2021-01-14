<?php

namespace App\Http\Controllers\API\Washing_ticket;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\code_table;
use App\Models\Store_manage\Custom_unit;
use App\Models\Store_manage\Product_manage;
use App\Models\Store_manage\Service;
use App\Models\Washing_tickets\Car;
use App\Models\Washing_tickets\Car_washing;
use App\Models\Washing_tickets\Inform;
use Illuminate\Http\Request;
use Symfony\Polyfill\Intl\Idn\Info;

class Car_washingController extends Controller
{
    public function index($filter,$one,$two){
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

        if($filter==1){
            $cars=Car_washing::where('ticket_date','>=',$one);
            if($two!='xx')
                $cars->where('ticket_date','<=',$two);
            return $cars->paginate(5);
        }

        if($filter==2){
            $cars=Car_washing::where('receipt_time','>=',$one);
            if($two!='xx')
                $cars->where('exit_time','>=',$two);
            return $cars->paginate(5);
        }

        if($filter==3)
            return Car_washing::where('id',$one)->paginate(5);

        return Car_washing::paginate(5);
    }

    public function check_car_number($number,$letters){
        dd(strlen($letters));
        if(strlen($letters)!=3)
            return 'letter_error';
        if(strlen($number)>4){
            return 'num_error';
        }
        $car=Car::where(['car_number'=>$number,'car_letters'=>$letters])->first();
        return $car??'';
    }

    public function get_total_services($ticket_id){
        return Service::where(['ticket_id'=>$ticket_id,'type'=>1])->count();
    }

    public function car_washing_get_total_servs(){
        return Service::where(['type'=>1])->count();
    }

    public function car_washing_get_total_cost(){
        return Car_washing::sum('total_price');
    }

    public function get_total_tickets(){
        $tickets=Car_washing::count('id');
        return $tickets;
    }

    public function get_total_cost($ticket_id){
        return Service::where(['ticket_id'=>$ticket_id,'type'=>1])->sum('cost')+Service::where(['ticket_id'=>$ticket_id,'type'=>1])->sum('extra_cost');
    }

    public function get_total_discount($ticket_id){
        return Service::where(['ticket_id'=>$ticket_id,'type'=>1])->where('extra_cost','<','0')->sum('extra_cost')*-1;
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

    public function store(Request $request){
        $check_car=Car::where(['car_number'=>$request->car_number_num_ar,'car_letters'=>$request->car_number_letters_ar])->first();
        $car_id=0;
        if(!$check_car){
            $car=new Car;
            $car->car_number=$request->car_number_num_ar;
            $car->car_letters=$request->car_number_letters_ar;
            $car->brand=$request->brand;
            $car->color=$request->color;
            $car->status=$request->car_status;
            $car->client_id=$request->client;
            $car->save();
            $car_id=$car->id;
        }else{
            Car::where(['car_number'=>$request->car_number_num_ar,'car_letters'=>$request->car_number_letters_ar])->update([
                'brand'=>$request->brand,
                'color'=>$request->color,
                'status'=>$request->car_status,
                'client_id'=>$request->client,
            ]);
            $car_id=$check_car->id;
        }

        $car_wash=new Car_washing;
        $car_wash->serial_number=$request->serial_number;
        $car_wash->ticket_date=$request->ticket_date;
        $car_wash->wash=$request->wash;
        $car_wash->ticket_status=$request->ticket_status;
        $car_wash->car_id=$car_id;
        $car_wash->client_id=$request->client;
        $car_wash->total_discount=$request->total_discount;
        $car_wash->receipt_time=$request->receipt_time;
        $car_wash->exit_time=$request->exit_time;
        $car_wash->num_of_materials=$request->total_services;
        $car_wash->total_price=$request->total_cost;
        if($request->ticket_status==2)
            $car_wash->pended=1;
        if($request->ticket_status==3){
            $car_wash->pended=1;
            $car_wash->completed=1;
        }
        $car_wash->save();
        return response(['success','your data created successfully'],200);
    }

    public function update(Request $request,$id){
        $check_car=Car::where(['car_number'=>$request->car_number_num_ar,'car_letters'=>$request->car_number_letters_ar])->first();
        $car_id=0;
        if(!$check_car){
            $car=new Car;
            $car->car_number=$request->car_number_num_ar;
            $car->car_letters=$request->car_number_letters_ar;
            $car->brand=$request->brand;
            $car->color=$request->color;
            $car->status=$request->car_status;
            $car->client_id=$request->client;
            $car->save();
            $car_id=$car->id;
        }else{
            Car::where(['car_number'=>$request->car_number_num_ar,'car_letters'=>$request->car_number_letters_ar])->update([
                'brand'=>$request->brand,
                'color'=>$request->color,
                'status'=>$request->car_status,
                'client_id'=>$request->client,
            ]);
            $car_id=$check_car->id;
        }
        $car_wash=Car_washing::find($id);
        $car_wash->ticket_date=$request->ticket_date;
        $car_wash->wash=$request->wash;
        $car_wash->ticket_status=$request->ticket_status;
        $car_wash->car_id=$car_id;
        $car_wash->client_id=$request->client;
        $car_wash->total_discount=$request->total_discount;
        $car_wash->receipt_time=$request->receipt_time;
        $car_wash->exit_time=$request->exit_time;
        $car_wash->num_of_materials=$request->total_services;
        $car_wash->total_price=$request->total_cost;
        if($request->ticket_status==2)
            $car_wash->pended=1;
        if($request->ticket_status==3){
            $car_wash->pended=1;
            $car_wash->completed=1;
        }
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

    public function create_client(Request $request){
        Client::create($request->all());
    }

    public function get_client($id){
        return Client::find($id);
    }

    public function update_rate(Request $request){
        $client=Client::find($request->client_id);
        $client->status=$request->status;
        $client->save();
    }

    public function update_ticket_status(Request $request){
        $car=Car_washing::find($request->ticket_id);
        if($request->status==2){
            $car->pended=1;
            $car->receipt_time=date("h:i:s");
        }else if($request->status==3){
            $car->completed=1;
            $car->exit_time=date("h:i:s");
        }
        $car->ticket_status=$request->status;
        $car->save();
    }

    public function inform(Request $request){
        $inform=new Inform;
        $inform->ticket_id=$request->ticket_id;
        $inform->ticket_type=$request->ticket_type;
        $inform->topic=$request->topic;
        $inform->message=$request->message;
        $inform->save();
    }
}
