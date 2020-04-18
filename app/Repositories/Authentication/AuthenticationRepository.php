<?php
namespace App\Repositories\Authentication;
use App\User;
use Illuminate\Support\Facades\Hash;

class AuthenticationRepository implements AuthenticationRepositoryInterface {

    public function login($data)
    {
        $user = User::where('email', $data['email'])->where('password', Hash::make($data['password']))->get();
        if (count($user) > 0){
            return $response = array([
                'isSuccess' => true,
                'message'   => 'User Logged in Successfully',
                'data'      =>  $user
            ]);
        }else{
            return $response = array([
                'isSuccess' => false,
                'message'   => 'Invalid Email or Password'
            ]);
        }
    }

    public function register($data)
    {
        // TODO: Implement register() method.
    }

    public function forgetPassword($email)
    {
        // TODO: Implement forgetPassword() method.
    }
}
