<?php

namespace App\Http\Controllers\API\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Attendance_logController extends Controller
{
    public function machine_pull(){
        dd('pull from machine');
    }

    public function upload_attendance(){
        dd('attendance from file');
    }
}
