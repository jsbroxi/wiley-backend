<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ClothsModel extends Model
{
    protected $table = 'trn_clothes';

    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * @param $data
     * @return array
     */
    public function getList($data) {
        $query = 'SELECT '.
            'trn_clothes.name as productName,'.
            'trn_clothes.product_id,'.
            'trn_clothes.product_code,'.
            'trn_clothes.short_description,'.
            'trn_clothes.color,'.
            'trn_clothes.size,'.
            'trn_clothes.cost,'.
            'trn_clothes.selling_price,'.
            'trn_clothes.brand_id,'.
            'trn_brands.name FROM trn_clothes LEFT JOIN trn_brands on trn_brands.brand_id = trn_clothes.brand_id LIMIT '
            . $data["currentPage"] * 10 . ', 10';
        return DB::select($query);
    }

    /**
     * @return array
     */
    public function getCount() {
        $query = 'SELECT count(*) as count FROM trn_clothes';
        return DB::select($query);
    }

    /**
     * @param $inputArray
     * @return mixed
     */
    public function addCloths($inputArray) {
        ksort($inputArray);
        $inputArray = array_values($inputArray);
        DB::insert('INSERT INTO trn_clothes (brand_id, color, cost, name, product_code, short_description, selling_price, size) VALUES (?, ?, ?, ?, ?, ?, ?, ?)', $inputArray);
        return DB::select('SELECT LAST_INSERT_ID() AS last_insert_id')[0]->last_insert_id;
    }

    /**
     * @param $inputArray
     * @return mixed
     */
    public function deleteCloth($inputArray)
    {
        DB::insert('DELETE FROM trn_clothes where product_id  = '. $inputArray);
        return true;
    }

    /**
     * @param $inputArray
     * @return mixed
     */
    public function getById($inputArray) {
        return DB::select ('SELECT '.
            'trn_clothes.name as productName,'.
            'trn_clothes.product_code,'.
            'trn_clothes.short_description,'.
            'trn_clothes.color,'.
            'trn_clothes.size,'.
            'trn_clothes.cost,'.
            'trn_clothes.selling_price,'.
            'trn_clothes.brand_id,'.
            'trn_brands.name '.
            'FROM trn_clothes LEFT JOIN trn_brands on trn_brands.brand_id = trn_clothes.brand_id WHERE product_id = '. $inputArray);
    }

    /**
     * @param $inputArray
     * @return int
     */
    function editCloths($inputArray) {

        $updateString = '';
        $id = $inputArray['id'];
        unset($inputArray['id']);

        $data = [
            "brand_id" => $inputArray["brand"],
            "color" => $inputArray["color"],
            "cost" => $inputArray["cost"],
            "name" => $inputArray["name"],
            "product_code" => $inputArray["productCode"],
            "short_description" => $inputArray["sd"],
            "selling_price" => $inputArray["selling_price"],
            "size" =>  $inputArray["size"]
        ];


        foreach ($data as $key => $value) {
            $updateString = $updateString . $key . ' = "' . $value . '",';
        }
        $result = DB::update(
            'UPDATE trn_clothes SET ' . rtrim($updateString, ",") . ' WHERE product_id = ' . $id
        );
        return $result;
    }
}
