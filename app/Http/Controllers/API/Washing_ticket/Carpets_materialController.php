<?php

namespace App\Http\Controllers\API\Washing_ticket;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Store_manage\Service;
use DB;

class Carpets_materialController extends Controller
{
    public function index(){

    }

    public function show($id){
        $data=DB::table('services')
        ->join('custom_units','services.unit_id','custom_units.id')
        ->join('products_manages','services.product_id','products_manages.id')
        ->select('services.id as id','custom_units.name as units','products_manages.name as name','products_manages.name_ar',
                 'custom_units.cost')
        ->where('ticket_id',$id)
        ->paginate(5);
        return $data;
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
