<?php

namespace App\Http\Controllers\API\Washing_ticket;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Store_manage\Service;

class Carpets_materialController extends Controller
{
    public function index(){
    }

    public function show($id){
        return Service::where('ticket_id',$id)->paginate(5);
    }

    public function store(Request $request){
        $data=new Service;
        $data->ticket_id=$request->ticket_id;
        $data->product_id=$request->product_id;
        $data->unit_id=$request->unit_id;
        $data->cost=$request->cost;
        $data->save();
        return response(['success','your data created successfully'],200);
    }

    public function destroy($id){
        $data=Service::find($id)->delete();
        return response(['success','your data deleted successfully'],200);
    }


}
