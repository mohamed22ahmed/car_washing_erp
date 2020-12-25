<?php

namespace App\Models\ManageEmployees;

use Illuminate\Database\Eloquent\Model;

class Leave_Setup extends Model
{
    protected $table="leave_setups";
    protected $fillable=['id','name','name_ar','colour','description','max_days','max_applicable_days','applicable_after'];
}
