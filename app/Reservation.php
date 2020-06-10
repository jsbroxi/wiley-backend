<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $table = 'reservations';
    protected $fillable = ['occupancy','checkin','checkout','name'];
    public function nights()
    {
        return $this->hasMany('App\ReservationNight');
    }

    function user()
    {
        return $this->belongsTo('App\User');
    }

    function hotel()
    {
        return $this->belongsTo('App\Hotel');
    }
}
