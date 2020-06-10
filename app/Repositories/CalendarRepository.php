<?php


namespace App\Repositories;
use App\Interfaces\CalendarRepositoryInterface;
use App\RoomCalendar;
use App\RoomType;
use Illuminate\Support\Carbon;

/**
 * Handles the Calendar functions of the system
 *
 * @package  App\Repositories
 * @category Interfaces
 * @author   <Janaka bandara> <jsbnilantha@live.com>
 */
class CalendarRepository implements CalendarRepositoryInterface
{

    /**
     * This function checks the availability of a hotel in a given date range for a given number of guests
     * @param $data array the data from the request.
     * @return array contains the information about availability of each room type of a hotel
     */
    public function checkAvailability($data)
    {
        // Format the inputted dates
        $startDate = $data['start_date'];
        $endDate = $data['end_date'];

        // Get the user selected occupancy
        $minOccupancy = $data['min_occupancy'];

        // If it is not set populate all the rooms
        if (!isset($minOccupancy)) {
            $minOccupancy = RoomType::min('max_occupancy');
        }

        // If set, populate the rooms where max_occupancy is greater than minimum occupancy
        $roomTypes = RoomType::where('max_occupancy', '>=', $minOccupancy)->get();

        $availableRoomTypes = array();

        // Loop through each room
        foreach ($roomTypes as $roomType) {
            $count = RoomCalendar::where('day', '>=', $startDate)
                ->where('day','<', $endDate)
                ->where('room_type_id', '=', $roomType->id)
                ->where('availability', '<=', 0)
                ->where('hotel_id', '=', $data['hotelId'])
                ->count();

            // Populate available rooms
            if ($count == 0) {
                $total_price = RoomCalendar::where('day', '>=', $startDate)
                    ->where('day', '<', $endDate)
                    ->where('room_type_id', '=', $roomType->id)
                    ->sum('rate');

                // Create a new object called total price and
                // set its value equal to variable $total_price
                $roomType->total_price = $total_price;

                // Send the room type in the front end
                array_push($availableRoomTypes, $roomType);
            }
        }

        return $availableRoomTypes;
    }
}