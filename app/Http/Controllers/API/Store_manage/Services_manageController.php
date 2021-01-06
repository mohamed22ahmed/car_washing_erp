<?php

namespace App\Http\Controllers\API\Store_manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Store_manage\Material;

class Services_manageController extends Controller
{
    public function index(){}

    public function show($id){
        return Material::where('product_id',$id)->paginate(5);
    }

    public function store(Request $request){
        $data=new Material;
        $data->product_id=$request->product_id;
        $data->name=$request->name;
        $data->quantity=$request->quantity;
        $data->save();
        return response(['success','your data Stored successfully'],200);
    }

    public function destroy($id){
        $data=Material::find($id)->delete();
        return response(['success','your data deleted successfully'],200);
    }
}
