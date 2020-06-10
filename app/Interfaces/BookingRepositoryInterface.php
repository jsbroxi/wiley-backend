<?php


namespace App\Interfaces;

use Illuminate\Http\Request;

/**
 * Handles the Booking functions of the system
 *
 * @package  App\Interfaces
 * @category Interfaces
 * @author   <Janaka bandara> <jsbnilantha@live.com>
 */
interface BookingRepositoryInterface
{

    /**
     * This function generates a booking and updates the booking availabilty
     * @param $request array the request object from the frontend
     * @return array the details about newly created booking
     */
    public function createBooking($request);

    /**
     * This function retrieves a list of reservations of a particular user
     * @return array the reservation list
     */
    public function getBookingsDetails();

    /**
     * @param $request
     * @return array|mixed
     */
    public function checkIn($request);


    /**
     * @param $request
     * @return array|mixed
     */
    public function checkOut($request);


    /**
     * @param $request
     * @return array|mixed
     */
    public function orderSpa($request);


    /**
     * @param $request
     * @return array|mixed
     */
    public function orderFood($request);


    /**
     * @param  $request
     * @return array|mixed
     */
    public function orderPool($request);


    /**
     * @param $request
     * @return array|mixed
     */
    public function orderTaxi($request);

    /**
     * @param $request
     * @return array|mixed
     */
    public function deleteBooking($request);

}