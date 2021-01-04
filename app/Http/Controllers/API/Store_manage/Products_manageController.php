<?php

namespace App\Http\Controllers\API\Store_manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Store_manage\Product_manage;
use App\Models\Store_manage\Service;
use App\Models\Store_manage\Custom_unit;

class Products_manageController extends Controller
{
    public function index(){
        return Product_manage::paginate(5);
    }

    public function store(Request $request){
        $data=new Product_manage;
        $data->name =$request->name;
        $data->name_ar = $request->name_ar;
        $data->classifications = $request->classifications;
        $data->type = $request->type;
        $data->part_unit =$request->part_unit;
        $data->default_unit =$request->default_unit;
        $data->unit_parts = $request->unit_parts;
        $data->unit_price = $request->unit_price;
        $data->save();
        return response(['success','your data Stored successfully'],200);
    }

    public function update(Request $request,$id){
        $data=Product_manage::find($id);
        $data->name =$request->name;
        $data->name_ar = $request->name_ar;
        $data->classifications = $request->classifications;
        $data->type = $request->type;
        $data->part_unit =$request->part_unit;
        $data->default_unit =$request->default_unit;
        $data->unit_parts = $request->unit_parts;
        $data->unit_price = $request->unit_price;
        $data->save();
        return response(['success','your data Updated successfully'],200);
    }

    public function destroy($id){
        $data=Product_manage::find($id)->delete();
        return response(['success','your data deleted successfully'],200);
    }
}
