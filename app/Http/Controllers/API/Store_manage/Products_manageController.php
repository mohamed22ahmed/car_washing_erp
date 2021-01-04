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

    public function get_units(){
        return Custom_unit::paginate(5);
    }

    public function get_services(){
        return Service::paginate(5);
    }
}
