<?php

namespace App\Interfaces;

interface UserRepositoryInterface
{
    public function registerUser($data);


    public function loginUser($data);

    public function logout($data);
}
