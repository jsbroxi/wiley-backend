<?php

namespace App\Http\Controllers;

use App\Interfaces\UserRepositoryInterface;
use App\Helpers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;


class UserController extends Controller
{
    private $userRepo;
    private $helper;
    public function __construct(
        Helpers\Helper $helper,
        UserRepositoryInterface $userRepository
    ) {
        $this->helper = $helper;
        $this->userRepo = $userRepository;
    }


    public function register(Request $request)
    {
        try {
            $arrData = $request->all();
            $arrResult = $this->userRepo->registerUser($arrData);
            if (!$arrResult['success']) {
                return $this->helper->response([], $arrResult['message'], false, 401);
            }
            return $this->helper->response($arrResult['data'], $arrResult['message']);
        } catch (\Exception $ex) {
            return $this->helper->response([], trans("auth.error_in_login"), false);
        }
    }


    public function login(Request $request){
        try {
            $arrData = $request->all();
            $arrResult = $this->userRepo->loginUser($arrData);
            if (!$arrResult['success']) {
                return $this->helper->response([], $arrResult['message'], false, 401);
            }
            return $this->helper->response($arrResult['data'], $arrResult['message']);
        } catch (\Exception $ex) {
            return $this->helper->response([], "error in login", false);
        }
    }

    public function logout(Request $request)
    {
        try {
            $arrData = $request->all();
            $arrResult =  $this->userRepo->logout($arrData);

            if (!$arrResult['success']) {
                return $this->helper->response([], $arrResult['message'], false);
            }
            return $this->helper->response($arrResult['data'], $arrResult['message']);
        } catch (\Exception $ex) {
            return $this->helper->response([], trans("auth.logout_failed"), false);
        }
    }
}
