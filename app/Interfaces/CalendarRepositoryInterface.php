<?php

namespace App\Interfaces;

/**
 * Handles the Calendar functions of the system
 *
 * @package  App\Interfaces
 * @category Interfaces
 * @author   <Janaka bandara> <jsbnilantha@live.com>
 */
interface CalendarRepositoryInterface
{
    /**
     * This function checks the availability of a hotel in a given date range for a given number of guests
     * @param $data array the data from the request.
     * @return array contains the information about availability of each room type of a hotel
     */
    public function checkAvailability($data);
}
