<?php

namespace App\Http\Controllers;
use App\Helpers\Helper;
use App\Interfaces\HotelRepositoryInterface;
use Illuminate\Http\Request;


/**
 * Handles the hotels' functions of the system
 *
 * @package  App\Http\Controllers
 * @category Controllers
 * @author   <Janaka bandara> <jsbnilantha@live.com>
 */
class HotelController extends Controller
{
    private $helper;
    private $hotelRepository;

    public function __construct(Helper $helper, HotelRepositoryInterface $hotelRepository)
    {
        $this->helper = $helper;
        $this->hotelRepository = $hotelRepository;
    }

    /**
     * @param Request $request
     * @return array|mixed
     */
    public function getHotelList(Request $request)
    {
        try {
            $data = $request->all();
            $data = $this->hotelRepository->getHotelsList($data);

            if ($data["success"]) {
                return $this->helper->getReturnData($data, $data["message"], true);
            }

        } catch (\Exception $e) {
            dd($e);
            return $this->helper->getReturnData([], trans('app.hotel.error'), false);
        }

    }
}
