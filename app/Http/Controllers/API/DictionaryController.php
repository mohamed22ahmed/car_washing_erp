<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Dictionary;
use Illuminate\Http\Request;

class DictionaryController extends Controller
{
    public function index(){
        $lang=session('lang');
        if ($lang=='ar')
            $data=Dictionary::select('dic_id','name_ar')->pluck('name_ar','dic_id');
        else
            $data=Dictionary::select('dic_id','name')->pluck('name','dic_id');
        return  $data;
    }
}
