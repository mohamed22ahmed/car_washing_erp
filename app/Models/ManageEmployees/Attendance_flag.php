<?php

namespace App\Models\ManageEmployees;

use Illuminate\Database\Eloquent\Model;

class Attendance_flag extends Model
{
    protected $fillable=['id','name','name_ar','colour','description','status','shift'];
}
