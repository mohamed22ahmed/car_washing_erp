<?php

namespace App\Models\Washing_tickets;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable=['id','car_number','car_letters','brand','color','client_id'];
}
