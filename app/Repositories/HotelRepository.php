<?php


namespace App\Repositories;
use App\Helpers\Helper;
use App\Hotel;
use App\Interfaces\HotelRepositoryInterface;

/**
 * Handles the Hotel functions of the system
 *
 * @package  App\Repositories
 * @category Interfaces
 * @author   <Janaka bandara> <jsbnilantha@live.com>
 */
class HotelRepository implements HotelRepositoryInterface
{
    private $hotelModel;
    private $helper;

    public function __construct(Hotel $hotel, Helper $helper) {
        $this->hotelModel = $hotel;
        $this->helper = $helper;

    }

    /**
     * This function retrieves the available hotels in the system
     * @param $request array the request object
     * @return array contains a array of hotels in the system
     */
    public function getHotelsList($request)
    {
        $result = $this->hotelModel->read(null, $request);
        return $this->helper->getReturnData($result, trans('app.hotel.hotel_list'));
    }
}