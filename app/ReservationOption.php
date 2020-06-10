<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReservationOption extends Model
{
    protected $fillable = ['reservation_id', 'option_id'];
}
