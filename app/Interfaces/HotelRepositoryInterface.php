<?php


namespace App\Interfaces;

/**
 * Handles the Hotel functions of the system
 *
 * @package  App\Interfaces
 * @category Interfaces
 * @author   <Janaka bandara> <jsbnilantha@live.com>
 */
interface HotelRepositoryInterface
{
    /**
     * This function retrieves the available hotels in the system
     * @param $request array the request object
     * @return array contains a array of hotels in the system
     */
    public function getHotelsList($request);
}