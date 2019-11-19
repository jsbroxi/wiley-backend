<?php
namespace App\Repositories;

use App\Helpers\Helper;
use App\Interfaces\UserRepositoryInterface;
use App\User;
use Illuminate\Support\Facades\Auth;

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

    public function registerUser($data)
    {
        try {
            $input['password'] = bcrypt($data['password']);
            $user = User::create($data);
            $success['token'] = $user->createToken('MyApp')->accessToken;
            $success['name'] = $user->name;

            return $this->helper->getResponseData([], "user created", true);
        } catch (\Exception $e) {
            return $this->helper->getResponseData([], "user creat error", false);
        }
    }

    public function loginUser($data)
    {
        if(\Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = \Auth::user();
            $success['token'] =  $user->createToken('MyApp')-> accessToken;
            return $this->helper->getResponseData($success, "user logged in", true);
        }
        else{
            return $this->helper->getResponseData([], "login error", false);
        }
    }

    public function logout($data)
    {
        Auth::user()->token()->revoke();
        return $this->helper->getReturnData([],"success", true);
    }
}
