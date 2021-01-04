<?php

namespace App\Http\Controllers\API\Store_manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Store_manage\Product_manage;
use App\Models\Store_manage\Service;
use App\Models\Store_manage\Custom_unit;

class Services_manageController extends Controller
{
    public function index(){
        return Service::paginate(5);
    }

    public function store(Request $request){
        $data=new Service;
        $data->name =$request->name;
        $data->quantity = $request->quantity;
        $data->save();
        return response(['success','your data Stored successfully'],200);
    }

    public function destroy($id){
        $data=Service::find($id)->delete();
        return response(['success','your data deleted successfully'],200);
    }
}
