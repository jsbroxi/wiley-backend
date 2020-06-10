<?php

namespace App\Interfaces;

/**
 * Handles the Authentication functions of the system
 *
 * @package  App\Interfaces
 * @category Interfaces
 * @author   <Janaka bandara> <jsbnilantha@live.com>
 */
interface UserRepositoryInterface
{
    /**
     * This function registers a user into the system and generates tokens for him
     * @param $data array the data from the request.
     * @return array contains the details about newly created user
     */
    public function registerUser($data);

    /**
     * This function logs a user into the system and generates tokens for him
     * @param $data array the data from the request.
     * @return array contains the details about logged user
     */
    public function loginUser($data);

    /**
     * This function logs a user out from the system and revokes his token
     * @param $data array the data from the request.
     * @return array contains the details the login status
     */
    public function logout($data);
}
