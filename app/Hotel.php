<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Hotel extends Model
{
    protected $table = 'hotel';
    protected $fillable = ['name', 'location'];


    public function reservations()
    {
        return $this->hasMany('App\Reservation');
    }

    /**
     * Read data from the table
     *
     * @param int   $id Id
     * @param array $pagination Pagination
     *
     * @return array
     */
    public function read($id = null, $pagination = [])
    {

        $currentPage = null;
        $arrData = [];
        $limitStr = "";

        $query = 'SELECT * from hotel';

        $whereStr = $id ? ' WHERE hotel.id = '. $id : " ";

        $arrResult =  DB::select($query . $whereStr . $limitStr);
        $arrData['data'] = $arrResult;
        $arrData['count'] = count($arrResult);

        if (array_key_exists('total_count', $pagination) && $pagination['total_count'] == 1) {
            $totalRowCount = DB::select('SELECT COUNT(*) AS count FROM hotel ' . $whereStr);
            $arrData['total_count'] = count($totalRowCount) ? $totalRowCount[0]->count : 0;
        }

        return $arrData;
    }

}
