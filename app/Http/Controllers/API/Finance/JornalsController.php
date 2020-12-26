<?php

namespace App\Http\Controllers\API\Finance;

use App\Http\Controllers\Controller;
use App\Models\Finance\Jornal;
use App\Models\Finance\Jornal_details;
use Illuminate\Http\Request;

class JornalsController extends Controller
{
    public function index(){
        return Jornal::all();
    }

    public function get_jornal_id(){
        return Jornal::max('id')+1;
    }

    public function jornal_details($id){
        return Jornal_details::where('jornal_id',$id)->get();
    }

    public function store(Request $request){
        $jor=new Jornal;
        $jor->jor_date=$request->jor_date;
        $jor->currency=$request->currency;
        $jor->jor_number=$request->jor_number;
        $jor->description=$request->description;
        $jor->save();
    }

    public function update(Request $request,$id){
        $jor=Jornal::find($id);
        $jor->jor_date=$request->jor_date;
        $jor->currency=$request->currency;
        $jor->jor_number=$request->jor_number;
        $jor->description=$request->description;
        $jor->save();
    }

    public function destroy($id){
        Jornal::find($id)->delete();
        Jornal_details::where('jornal_id',$id)->delete();
    }

    public function jornal_details_create(Request $request){
        $jor=new jornal_details;
        $jor->jornal_id=$request->jornal_id;
        $jor->acc_name=$request->acc_name;
        $jor->description=$request->description;
        $jor->depit=$request->depit;
        $jor->credit=$request->credit;
        $jor->save();
    }

    public function jornal_details_update(Request $request){
        $jor=jornal_details::find($request->id);
        $jor->jornal_id=$request->jornal_id;
        $jor->acc_name=$request->acc_name;
        $jor->description=$request->description;
        $jor->depit=$request->depit;
        $jor->credit=$request->credit;
        $jor->save();
    }   

    public function jornal_details_delete($id){
        Jornal_details::find($id)->delete();
    }
}
