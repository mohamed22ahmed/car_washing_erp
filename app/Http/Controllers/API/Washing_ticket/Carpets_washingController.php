<?php

namespace App\Http\Controllers\API\Wahing_ticket;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Washing_tickets\Carpet_washing;

class Carpets_washingController extends Controller
{
    public function index(){
        return Carpet_washing::paginate(5);
    }

    public function store(Request $request){
        $data=new Carpet_washing;
        $data->ticket_date=$request->ticket_date;
        $data->wash=$request->wash;
        $data->ticket_status=$request->ticket_status;
        $data->client=$request->client;
        $data->phone_number=$request->phone_number;
        $data->carpet_size=$request->carpet_size;
        $data->wash_type=$request->wash_type;
        $data->receipt_date=$request->receipt_date;
        $data->expected_exit_date=$request->expected_exit_date;
        $data->save();
        return response(['success','your data created successfully'],200);
    }

    public function update(Request $request,$id){
        $data=Carpet_washing::find($id);
        $data->ticket_date=$request->ticket_date;
        $data->wash=$request->wash;
        $data->ticket_status=$request->ticket_status;
        $data->client=$request->client;
        $data->phone_number=$request->phone_number;
        $data->carpet_size=$request->carpet_size;
        $data->wash_type=$request->wash_type;
        $data->receipt_date=$request->receipt_date;
        $data->expected_exit_date=$request->expected_exit_date;
        $data->save();
        return response(['success','your data Updated successfully'],200);
    }

    public function destroy($id){
        $data=Carpet_washing::find($id)->delete();
        return response(['success','your data deleted successfully'],200);
    }


}
