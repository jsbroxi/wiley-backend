<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    protected $table = 'room_type';
    protected $fillable = ['name', 'short_name','max_occupancy','base_price','base_availability'];
}
