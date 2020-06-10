<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Interfaces\CalendarRepositoryInterface;
use App\Interfaces\HotelRepositoryInterface;
use App\RoomCalendar;
use App\RoomType;
use Illuminate\Http\Request;

/**
 * Handles the calendar of the system
 *
 * @package  App\Http\Controllers
 * @category Controllers
 * @author   <Janaka bandara> <jsbnilantha@live.com>
 */
class CalendarController extends Controller
{

    private $helper;
    private $calendarRepo;

    public function __construct(Helper $helper, CalendarRepositoryInterface $calendarRepository)
    {
        $this->helper = $helper;
        $this->calendarRepo = $calendarRepository;
    }

    /**
     * @param Request $request
     * @return array|mixed
     */
    public function searchAvailability(Request $request)
    {
        try {
            $data = $request->all();
            $data = $this->calendarRepo->checkAvailability($data["data"]);

            if (isset($data)) {
                return $this->helper->getReturnData($data, "Successfully retrieved data", true);
            }

        } catch (\Exception $e) {
            dd($e);
        }
    }
}
