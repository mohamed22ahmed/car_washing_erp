<?php

namespace App\Http\Controllers\API\Store_manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Store_manage\Product_manage;
use App\Models\Store_manage\Service;
use App\Models\Store_manage\Custom_unit;

class Units_manageController extends Controller
{
    public function index(){}
    public function show($id){
        return Custom_unit::where('product_id',$id)->paginate(5);
    }

    public function store(Request $request){
        $data=new Custom_unit;
        $data->name=$request->name;
        $data->product_id=$request->product_id;
        $data->units=$request->units;
        $data->cost=$request->cost;
        $data->save();
        return response(['success','your data Stored successfully'],200);
    }

    public function destroy($id){
        $data=Custom_unit::find($id)->delete();
        return response(['success','your data deleted successfully'],200);
    }
}
