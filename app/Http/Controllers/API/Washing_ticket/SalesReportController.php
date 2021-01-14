<?php

namespace App\Http\Controllers\API\Washing_ticket;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Washing_tickets\Carpet_washing;
use App\Models\Washing_tickets\Car_washing;
use App\Models\Store_manage\Service;
use DB;

class SalesReportController extends Controller
{
    public function index($filter){
        if($filter==2){
        $data=DB::table('services')
            ->leftJoin('carpet_washings','services.ticket_id','carpet_washings.id')
            ->select('carpet_washings.id','carpet_washings.ticket_date',
                    DB::raw("SUM(carpet_washings.total_price) as totalSum"),
                    DB::raw("count(services.unit_id) as totalServices"))
            ->groupBy('services.cost','carpet_washings.id','carpet_washings.ticket_date','services.unit_id')
            ->where(['type'=>'2','ticket_status'=>3])
            ->paginate(5);
            return $data;
        }
        if($filter==1){
            $data=DB::table('services')
            ->leftJoin('car_washings','services.ticket_id','car_washings.id')
            ->select('car_washings.id','car_washings.ticket_date',
                    DB::raw('SUM(car_washings.total_price) as totalSum'),
                    DB::raw('count(services.unit_id) as totalServices'))
            ->groupBy('services.cost','car_washings.id','car_washings.ticket_date','services.unit_id')
            ->where(['type'=>'1','ticket_status'=>3])
            ->paginate(10);
            return $data;
        }
    }

    public function get_user(){
        return session('user')->name;
    }

    public function get_total_cost($filter){
        if($filter==1){
            $a=Service::where(['type'=>1])->sum('cost');
            $b=Car_washing::sum('total_price');
            return $a+$b;
        }
        if($filter==2){
            $a=Service::where(['type'=>2])->sum('cost');
            $b=Carpet_washing::sum('total_price');
            return $a+$b;
        }
    }

    public function get_total_servs($filter){
        if($filter==1){
            return Service::where(['type'=>1])->count();
        }
        if($filter==2){
            return Service::where(['type'=>2])->count();
        }
    }

    public function get_total_fin_cost($filter){
        if($filter==1){
            return Car_washing::where('ticket_status','=',3)->sum('total_price');
        }
        if($filter==2){
            return Carpet_washing::where('ticket_status','=',3)->sum('total_price');
        }
    }

    public function get_total_tickets($filter){
        if($filter==1){
            return Car_washing::where('ticket_status','=',3)->count('id');
        }
        if($filter==2){
            return Carpet_washing::where('ticket_status','=',3)->count('id');
        }
    }


}
