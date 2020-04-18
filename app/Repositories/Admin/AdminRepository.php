<?php
namespace App\Repositories\Admin;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminRepository implements AdminRepositoryInterface {
    public function get_admin_profile()
    {
        $data = User::all()->where('role', 1);
        $passowrd = User::where('id', Auth::id())->pluck('password');
        return  array('data' => $data, 'password' => $passowrd);
    }

    public function passwordUpdate($data){
        $current_password = User::where('id', Auth::id())->pluck('password');

        if($current_password[0] == $data['current_password']) {
            User::where('id', Auth::id())->update(['password' => Hash::make($data['new_password'])]);
            return $result = array(
                'isSuccess' => true,
                'message' => 'Password Updated Successfully'
            );
        }else{
            return $result = array(
                'isSuccess' => false,
                'message' => 'Incorrect Current Password');
        }

    }

    public function validation(){
        return $result = array(
            'isSuccess' => false,
            'message' => 'Must must be 8 character long'
        );
    }
}
