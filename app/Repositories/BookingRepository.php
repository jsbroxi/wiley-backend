<?php


namespace App\Repositories;
use App\Interfaces\BookingRepositoryInterface;
use App\Reservation;
use App\ReservationNight;
use App\ReservationOption;
use App\RoomCalendar;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

/**
 * Handles the Booking functions of the system
 *
 * @package  App\Repositories
 * @category Interfaces
 * @author   <Janaka bandara> <jsbnilantha@live.com>
 */
class BookingRepository implements BookingRepositoryInterface
{

    /**
     * This function generates a booking and updates the booking availabilty
     * @param $request array the request object from the frontend
     * @return Reservation the details about newly created booking
     */
    public function createBooking($request)
    {
        // Get the start date & end date that came from the reservationData
        $start_dt = Carbon::parse($request['startDate']);
        $end_dt = Carbon::parse($request['endDate']);

        // Create or update a customer info
        $customer = Auth::user();

        // Set the reservations table
        $reservation = new Reservation();


        // Get the values of the reservation
        $reservation->total_price = $request['totalPrice'];
        $reservation->occupancy = $request['occupancy'];
        $reservation->customer_id = $customer->id;
        $reservation->checkin = $start_dt;
        $reservation->checkout = $end_dt;
        $reservation->hotel_id = $request["hotelId"];
        // Save the changes on the reservation table
        $reservation->save();

        // Set the $date variable to $start_dt
        $date = $start_dt;

        // Loop through start date and end date of user choice
        while (strtotime($date) < strtotime($end_dt)) {
            // Set the $room_calendar variable where the day is equal to the start date
            // And the room_type_id column is equal the the $room_info object id
            $room_calendar = RoomCalendar::where('day', '=', $date)
                ->where('room_type_id', '=', $request['roomId'])->first();

            // Set the reservation_nights table
            $night = new ReservationNight();
            // Set the day column equal to the start date
            $night->day = $date;

            $night->rate = $room_calendar->rate;
            $night->room_type_id = $request['roomId'];
            $night->reservation_id = $reservation->id;

            // Update the availability column to minus one and
            // reservation column to plus one
            $room_calendar->availability--;
            $room_calendar->reservations++;
            // Save changes to the room_calendars table
            $room_calendar->save();
            $night->save();

            $date = date("Y-m-d", strtotime("+1 day ", strtotime($date)));
        }

        return $reservation;
    }

    /**
     * This function retrieves a list of reservations of the logged user
     * @return array the reservation list
     */
    public function getBookingsDetails()
    {
        $returnData = [];
        $user = Auth::user();
        $reservations = Reservation::with(['hotel', 'nights'])->where('customer_id', '=', $user->id)->get();
        $tempData = $reservations->toArray();
        foreach ($tempData as $key => $temp) {
            $tempData2 = [];
            $tempData2['hotel'] = $temp['hotel'];
            unset($temp['hotel']);
            $tempData2['reservation_nights'] = $temp['nights'];
            unset($temp['nights']);
            $tempData2['booking'] = $temp;
            $returnData[] = $tempData2;
        }

        return $returnData;
    }

    /**
     * @param Request $request
     * @return array|mixed
     */
    public function checkIn($request)
    {
        $booking = Reservation::where('id', '=', $request["data"])->get();
        if ($booking[0]->status == 'checked_in' || $booking[0]->status == 'checked_out') {
            return false;
        } else {
            Reservation::where('id', '=', $request["data"])
                ->update(['status' => 'checked_in']);

            return true;
        }
    }

    /**
     * @param Request $request
     * @return array|mixed
     */
    public function checkOut($request)
    {
        $booking = Reservation::where('id', '=', $request["data"])->get();
        if ($booking[0]->status == 'checked_out' || $booking[0]->status == 'booked') {
            return false;
        } else {
            Reservation::where('id', '=', $request["data"]["bookingId"])
                ->update(['status' => 'checked_out']);

            // Need to update the room availability when the booking checked out
            if (isset($request["data"]['nights'])) {
                foreach ($request["data"]['nights'] as $night) {
                    $room_calendar = RoomCalendar::where('day', '=', Carbon::parse($night['day']))
                        ->where('room_type_id', '=', $night['room_type_id'])->first();
                    if (isset($room_calendar)) {
                        // Update the availability column to plus one and
                        // reservation column to minus one
                        $room_calendar->availability++;
                        $room_calendar->reservations--;
                        // Save changes to the room_calendars table
                        $room_calendar->save();
                    }
                }

            }

            return true;
        }
    }

    /**
     * @param Request $request
     * @return array|mixed
     */
    public function orderSpa($request)
    {
        $options = new ReservationOption();
        $options->reservation_id = $request['data'];
        $options->option_id = 1;
        $options->save();
        return true;
    }

    /**
     * @param Request $request
     * @return array|mixed
     */
    public function orderFood($request)
    {
        $options = new ReservationOption();
        $options->reservation_id = $request['data'];
        $options->option_id = 4;
        $options->save();
        return true;
    }

    /**
     * @param Request $request
     * @return array|mixed
     */
    public function orderPool($request)
    {
        $options = new ReservationOption();
        $options->reservation_id = $request['data'];
        $options->option_id = 2;
        $options->save();
        return true;
    }

    /**
     * @param Request $request
     * @return array|mixed
     */
    public function orderTaxi($request)
    {
        $options = new ReservationOption();
        $options->reservation_id = $request['data'];
        $options->option_id = 3;
        $options->save();
        return true;
    }

    /**
     * @param Request $request
     * @return array|mixed
     */
    public function deleteBooking($request)
    {
    }
}