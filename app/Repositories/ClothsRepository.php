<?php
namespace App\Repositories;
use App\ClothsModel;
use App\Helpers\Helper;
use App\Interfaces\ClothsRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ClothsRepository implements ClothsRepositoryInterface
{

    public $successStatus = 200;
    private $helper;
    private $clothsModel;

    /**
     * ClothsRepository constructor.
     * @param Helper $helper
     * @param ClothsModel $clothsModel
     */
    public function __construct(
        Helper $helper,
        ClothsModel $clothsModel
    ) {
        $this->helper = $helper;
        $this->clothsModel = $clothsModel;
    }

    /**
     * @param $data
     * @return array
     * @throws \Exception
     */
    public function getById($data)
    {
        try {
            $data = $this->clothsModel->getById($data);
            return $this->helper->getResponseData($data, "cloths list", true);
        } catch (\Exception $e) {
            throw $e;
            return $this->helper->getResponseData([], "cloths list", false);
        }
    }

    /**
     * @param $data
     * @return array
     * @throws \Exception
     */
    public function getList($data)
    {
        try {
            $data = $this->clothsModel->getList($data);
            $count = $this->clothsModel->getCount($data);
            $data["data"]["data"] = $data;
            $data["count"] = $count[0]->count;

            return $this->helper->getResponseData($data, "cloths list", true);
        } catch (\Exception $e) {
            throw $e;
            return $this->helper->getResponseData([], "cloths list", false);
        }
    }

    /**
     * @param $data
     * @return array
     */
    public function addCloths($data)
    {
        try {
            $sellingPrice = $this->calculateSellingPrice($data);
            $data["sellingPrice"] = $sellingPrice;
            $data = $this->clothsModel->addCloths($data);
            return $this->helper->getResponseData($data, "cloths added", true);
        } catch (\Exception $e) {
            return $this->helper->getResponseData([], "cloths list", false);
        }
    }

    /**
     * @param $data
     * @return array
     */
    public function editCloths($data)
    {
        try {

            $sellingPrice = $this->calculateSellingPrice($data["data"]);
            $data["data"]["selling_price"] = $sellingPrice;
             //  dd($data[""]);
            $data = $this->clothsModel->editCloths($data["data"]);
            return $this->helper->getResponseData($data, "cloths updated", true);
        } catch (\Exception $e) {
            throw $e;
            return $this->helper->getResponseData([], "cloths list", false);
        }
    }


    /**
     * @param $data
     * @return array
     */
    public function deleteCloths($data)
    {
        try {
            $data = $this->clothsModel->deleteCloth($data);
            return $this->helper->getResponseData($data, "cloths deleted", true);
        } catch (\Exception $e) {
            throw $e;
            return $this->helper->getResponseData([], "cloths error", false);
        }
    }


    /**
     * @param $data
     * @return float|int
     */
    public function calculateSellingPrice($data) {
        if ($data["brand"] == 2) {
            return $data["cost"] + ( ($data["cost"] * 15) / 100 );
        } elseif ($data["brand"] == 3) {
            return $data["cost"] + ( ($data["cost"] * 15) / 100 ) + 100;
        } else {
            return $data["cost"] + ( ($data["cost"] * 10) / 100 );
        }
    }


}
