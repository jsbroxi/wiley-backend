<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Interfaces\BookingRepositoryInterface;
use App\Interfaces\CalendarRepositoryInterface;
use Illuminate\Http\Request;

/**
 * Handles the Booking Engine of the system
 *
 * @package  App\Http\Controllers
 * @category Controllers
 * @author   <Janaka bandara> <jsbnilantha@live.com>
 */
class BookingController extends Controller
{
    private $helper;
    private $bookingRepository;

    public function __construct(Helper $helper, BookingRepositoryInterface $bookingRepository)
    {
        $this->helper = $helper;
        $this->bookingRepository = $bookingRepository;
    }

    /**
     * @param Request $request
     * @return array|mixed
     */
    public function createBooking(Request $request)
    {
        try {
            $data = $request->all();
            $data = $this->bookingRepository->createBooking($data["data"]);

            if (isset($data)) {
                return $this->helper->getReturnData($data, "Successfully retrieved data", true);
            }

        } catch (\Exception $e) {
            dd($e);
        }
    }


    /**
     * @param Request $request
     * @return array|mixed
     */
    public function getBookingsByUser(Request $request)
    {
        try {
            $data = $request->all();
            $data = $this->bookingRepository->getBookingsDetails();

            if (isset($data)) {
                return $this->helper->getReturnData($data, "Successfully retrieved data", true);
            }

        } catch (\Exception $e) {
            dd($e);
        }
    }


    /**
     * @param Request $request
     * @return array|mixed
     */
    public function checkIn(Request $request)
    {
        try {
            $data = $request->all();
            $data = $this->bookingRepository->checkIn($data);

            if ($data) {
                return $this->helper->getReturnData([], "Checked in Successfully", true);
            } else {
                return $this->helper->getReturnData(
                    [],
                    "Checked in Error. Please check the dates",
                    true
                );
            }

        } catch (\Exception $e) {
            dd($e);
        }
    }

    /**
     * @param Request $request
     * @return array|mixed
     */
    public function checkOut(Request $request)
    {
        try {
            $data = $request->all();
            $data = $this->bookingRepository->checkOut($data);

            if ($data) {
                return $this->helper->getReturnData([], "Checked Out Successfully", true);
            } else {
                return $this->helper->getReturnData(
                    [],
                    "Checked Out Error. Please check the dates",
                    true
                );
            }

        } catch (\Exception $e) {
            dd($e);
        }
    }

    /**
     * @param Request $request
     * @return array|mixed
     */
    public function orderSpa(Request $request)
    {
        try {
            $data = $request->all();
            $data = $this->bookingRepository->orderSpa($data);

            if (isset($data)) {
                return $this->helper->getReturnData($data, "Spa Ordered for You", true);
            }

        } catch (\Exception $e) {
            dd($e);
        }
    }

    /**
     * @param Request $request
     * @return array|mixed
     */
    public function orderFood(Request $request)
    {
        try {
            $data = $request->all();
            $data = $this->bookingRepository->orderFood($data);

            if (isset($data)) {
                return $this->helper->getReturnData($data, "Food Ordered Successfully", true);
            }

        } catch (\Exception $e) {
            return $this->helper->getReturnData([], "Food Order failed", false);
        }
    }

    /**
     * @param Request $request
     * @return array|mixed
     */
    public function orderPool(Request $request)
    {
        try {
            $data = $request->all();
            $data = $this->bookingRepository->orderPool($data);

            if (isset($data)) {
                return $this->helper->getReturnData($data, "Pool ordered Successfully", true);
            }

        } catch (\Exception $e) {
            return $this->helper->getReturnData([], "Pool Order failed", false);
        }
    }

    /**
     * @param Request $request
     * @return array|mixed
     */
    public function orderTaxi(Request $request)
    {
        try {
            $data = $request->all();
            $data = $this->bookingRepository->orderTaxi($data);

            if (isset($data)) {
                return $this->helper->getReturnData($data, "Taxi ordered Successfully", true);
            }

        } catch (\Exception $e) {
            return $this->helper->getReturnData([], "Taxi Order failed", false);
        }
    }

    /**
     * @param Request $request
     * @return array|mixed
     */
    public function deleteBooking(Request $request)
    {
        try {
            $data = $request->all();
            $data = $this->bookingRepository->orderTaxi($data);

            if (isset($data)) {
                return $this->helper->getReturnData($data, "Successfully retrieved data", true);
            }

        } catch (\Exception $e) {
            return $this->helper->getReturnData([], "Spa Order failed", false);
        }
    }
}
