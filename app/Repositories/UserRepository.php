<?php
namespace App\Repositories;

use App\Helpers\Helper;
use App\Interfaces\UserRepositoryInterface;
use App\User;
use Illuminate\Support\Facades\Auth;

/**
 * Handles the Authentication functions of the system
 *
 * @package  App\Repositories
 * @category Interfaces
 * @author   <Janaka bandara> <jsbnilantha@live.com>
 */
class UserRepository implements UserRepositoryInterface
{

    public $successStatus = 200;
    private $helper;
    public function __construct(
       Helper $helper
    )
    {
        $this->helper = $helper;
    }

    /**
     * This function registers a user into the system and generates tokens for him
     * @param $data array the data from the request.
     * @return array contains the details about newly created user
     */
    public function registerUser($data)
    {
        try {
            $data['password'] = bcrypt($data['password']);
            $user = User::create($data);
            $success['token'] = $user->createToken('MyApp')->accessToken;
            $success['user'] = $user;

            return $this->helper->getResponseData($success, "user created", true);
        } catch (\Exception $e) {
            return $this->helper->getResponseData([], "user creat error", false);
        }
    }

    /**
     * This function logs a user into the system and generates tokens for him
     * @param $data array the data from the request.
     * @return array contains the details about logged user
     */
    public function loginUser($data)
    {
        if(\Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = \Auth::user();
            $success['token'] =  $user->createToken('MyApp')-> accessToken;
            $success['user'] = $user;
            return $this->helper->getResponseData($success, "user logged in", true);
        }
        else{
            return $this->helper->getResponseData([], "login error", false);
        }
    }

    /**
     * This function logs a user out from the system and revokes his token
     * @param $data array the data from the request.
     * @return array contains the details the login status
     */
    public function logout($data)
    {
        Auth::user()->token()->revoke();
        return $this->helper->getReturnData([],"success", true);
    }
}
