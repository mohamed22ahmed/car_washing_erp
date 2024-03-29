<?php

namespace App\Http\Controllers\API\Washing_ticket;

use App\Http\Controllers\Controller;
use App\Models\Store_manage\Custom_unit;
use App\Models\Store_manage\Product_manage;
use App\Models\Store_manage\Service;
use App\Models\Washing_tickets\Car_washing;
use Illuminate\Http\Request;
use App\Models\Washing_tickets\Carpet_washing;
use DB;

class Carpets_washingController extends Controller
{
    public function get_total_services($ticket_id){
        return Service::where(['ticket_id'=>$ticket_id,'type'=>2])->count();
    }

    public function get_total_cost($ticket_id){
        return Service::where(['ticket_id'=>$ticket_id,'type'=>2])->sum('cost')+Service::where(['ticket_id'=>$ticket_id,'type'=>2])->sum('extra_cost');
    }

    public function get_total_discount($ticket_id){
        return Service::where(['ticket_id'=>$ticket_id,'type'=>2])->where('extra_cost','<','0')->sum('extra_cost')*-1;
    }

    public function carpet_washing_get_total_servs(){
        return Carpet_washing::sum('num_of_materials');
    }

    public function carpet_washing_get_total_cost(){
        return Carpet_washing::sum('total_price');
    }

    public function get_total_tickets(){
        return Carpet_washing::count('id');
    }

    public function get_id(){
        return Carpet_washing::max('id')+1;
    }

    public function get_product_manages(){
        return Product_manage::where('classifications',2)->get();
    }

    public function get_units($product_id){
        return Custom_unit::where('product_id',$product_id)->get();
    }

    public function get_cost($unit_id){
        $unit=Custom_unit::where('id',$unit_id)->first();
        return $unit->cost;
    }

    public function index($filter,$one,$two){
        $cars=DB::table('carpet_washings')
        ->leftJoin('clients','clients.id','carpet_washings.client_id')
        ->select('carpet_washings.*','carpet_washings.id as id' ,'clients.name as client',
        'carpet_washings.serial_number as serial_number')
        ->paginate(5);
        $services=Service::where('type',2)->get();
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
            $cars=Carpet_washing::where('receipt_date','>=',$one);
            if($two!='xx')
                $cars->where('exit_expected_date','>=',$two);
            return $cars->paginate(5);
        }

        if($filter==2){
            $cars=Carpet_washing::where('receipt_time','>=',$one);
            if($two!='xx')
                $cars->where('exit_time','>=',$two);
            return $cars->paginate(5);
        }

        if($filter==3)
            return Carpet_washing::where('id',$one)->paginate(5);

        return $cars;
    }

    public function store(Request $request){
        $data=new Carpet_washing;
        $data->serial_number=$request->serial_number;
        $data->ticket_date=$request->ticket_date;
        $data->wash=$request->wash;
        $data->ticket_status=$request->ticket_status;
        $data->client_id=$request->client;
        $data->carpet_size=$request->carpet_size;
        $data->wash_type=$request->wash_type;
        $data->receipt_date=$request->receipt_date;
        $data->expected_exit_date=$request->expected_exit_date;
        $data->receipt_time=$request->receipt_time;
        $data->exit_time=$request->exit_time;
        $data->num_of_materials=$request->total_services;
        $data->total_price=$request->total_cost;
        $data->total_discount=$request->total_discount;
        if($request->ticket_status==2)
            $data->pended=1;
        if($request->ticket_status==3){
            $data->pended=1;
            $data->completed=1;
        }
        $data->save();
        return response(['success','your data created successfully'],200);
    }

    public function update(Request $request,$id){
        $data=Carpet_washing::find($id);
        $data->ticket_date=$request->ticket_date;
        $data->wash=$request->wash;
        $data->ticket_status=$request->ticket_status;
        $data->client_id=$request->client;
        $data->carpet_size=$request->carpet_size;
        $data->wash_type=$request->wash_type;
        $data->receipt_date=$request->receipt_date;
        $data->expected_exit_date=$request->expected_exit_date;
        $data->receipt_time=$request->receipt_time;
        $data->exit_time=$request->exit_time;
        $data->num_of_materials=$request->total_services;
        $data->total_price=$request->total_cost;
        $data->total_discount=$request->total_discount;
        if($request->ticket_status==2)
            $data->pended=1;
        if($request->ticket_status==3){
            $data->pended=1;
            $data->completed=1;
        }
        $data->save();
        return response(['success','your data Updated successfully'],200);
    }

    public function destroy($id){
        Carpet_washing::find($id)->delete();
        return response(['success','your data deleted successfully'],200);
    }

    public function show_ticket($id){
        // dd($id);
        $carpets=DB::table('carpet_washings')
        ->leftJoin('clients','clients.id','carpet_washings.client_id')
        ->leftJoin('code_tables as codes', function ($join) {
            $join->on('carpet_washings.carpet_size', '=', 'codes.sys_code');
            $join->on('codes.sys_code_type', '=', DB::raw('4'));
        })
        ->select('carpet_washings.*','carpet_washings.id as id','clients.name as client',
        'codes.name as carpet_size','carpet_washings.serial_number as serial_number','clients.phone as phone',)
        ->where('carpet_washings.id',$id)
        ->get();
        return $carpets;
    }

    public function get_serial(){
        $serial=Carpet_washing::max('id')+1;
        $ser=0;
        if($serial<=9)
            $ser=' 000'.$serial;
        else if($serial<=99)
            $ser=' 00'.$serial;
        else if($serial<=999)
            $ser=' 0'.$serial;
        else
            $ser=' '.$serial;
        $serial=date('Y').' 0220'.$ser;
        return $serial;
    }

    public function update_ticket_status_carpet(Request $request){
        $car=Carpet_washing::find($request->ticket_id);
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
}
