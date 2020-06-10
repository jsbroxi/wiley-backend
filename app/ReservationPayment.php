<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReservationPayment extends Model
{
    protected $fillable = ['reservation_id', 'is_paid', 'payment_token'];
}
