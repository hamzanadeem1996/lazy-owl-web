<?php
namespace App\Repositories\User;
use App\User;
use App\UserQualification;
use App\UserPortfolio;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserInterface {

    public function deleteAccount($id){
        $user = User::find($id);
        $user->delete();
        return true;
    }

    public function addProfileImage($data){
        $user = User::find($data['user_id']);

        if ($data['image'] != null) {
            $files = $data['file'];
            $destinationPath = 'images/user/';
            $categoryImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $categoryImage);
            $data['image'] = "$categoryImage";
            $user->image = $data['image'];

            if ($user->save()){
                return $result = array(
                    'isSuccess' => true,
                    'imageName' => $user->image,
                    'message' => "Profile Image Updated Successfully"
                );
            }else{
                return $result = array(
                    'isSuccess' => false,
                    'message' => 'Internal Server Error'
                );
            }
        }else{
            return $result = array(
                'isSuccess' => false,
                'message' => 'Internal Server Error'
            );
        }
    }

    public function add($data){
        $user = new User();
        $check = User::where('email', $data['email'])->get();
        if (count($check) > 0){
            return $result = array(
                'isSuccess' => false,
                'message' => 'Email already exists'
            );
        }else{
            $check = User::where('phone', $data['phone'])->get();
            if (count($check) > 0){
                return $result = array(
                    'isSuccess' => false,
                    'message' => 'Phone already exists'
                );
            }else{
                $user->role = $data['role'];
                $user->name = $data['name'];
                $user->gender = $data['gender'];
                $user->email = $data['email'];
                $user->password = Hash::make($data['password']);
                $user->phone = $data['phone'];
                $user->address = $data['address'];

                if ($data['files'] != null) {
                    $files = $data['files'];
                    $destinationPath = 'images/user/';
                    $categoryImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
                    $files->move($destinationPath, $categoryImage);
                    $data['image'] = "$categoryImage";
                    $user->image = $data['image'];
                }

                if ($user->save()){
                    if ($data['role'] == 2 || $data['role'] == "2"){
                        $message = 'User Registered Successfully';
                    }elseif ($data['role'] == 3 || $data['role'] == "3"){
                        $message = 'Service Provider Registered Successfully';
                    }else{
                        $message = 'Consultant Registered Successfully';
                    }
                    return $result = array(
                        'isSuccess' => true,
                        'message' => $message
                    );
                }else{
                    return $result = array(
                        'isSuccess' => false,
                        'message' => 'Internal Server Error'
                    );
                }
            }
        }

    }

    public function all($role){
        return User::where('status', 1)
            ->where('role', $role)->get();
    }

    public function disabled($role){
        return User::where('status', 0)
            ->where('role', $role)->get();
    }

    public function get($id){
        return User::find($id);
    }

    public function update($data){
        $user = User::find($data['id']);
        if (isset($user) > 0){
            $user->name = $data['name'];
            $user->gender = $data['gender'];
            $user->phone = $data['phone'];
            $user->address = $data['address'];

            if (isset($data['files'])) {
                $files = $data['files'];
                $destinationPath = 'images/user/';
                $categoryImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
                $files->move($destinationPath, $categoryImage);
                $data['image'] = "$categoryImage";
                $user->image = $data['image'];
            }else{
                $user->image = $data['default_image'];
            }

            if ($user->save()){
                return $result = array(
                    'isSuccess' => true,
                    'message' => 'User Updated Successfully'
                );
            }else{
                return $result = array(
                    'isSuccess' => false,
                    'message' => 'Internal Server Error'
                );
            }
        }else{
            return $result = array(
                'isSuccess' => false,
                'message' => 'User does not exists'
            );
        }
    }

    public function delete($id){
        $user = User::find($id);
        if ($user->status == 0){
            $user->status = 1;
            $message = 'Activated Successfully';
        }else{
            $user->status = 0;
            $message = 'Disabled Successfully';
        }

        if ($user->role == 2){
            $role = 'User ';
        }elseif ($user->role == 3){
            $role = 'Service Provider ';
        }else{
            $role = 'Consultant ';
        }

        if ($user->save()){
            return $result = array(
                'isSuccess' => true,
                'message' => $role.$message
            );
        }else{
            return $result = array(
                'isSuccess' => false,
                'message' => 'Internal Server Error'
            );
        }
    }

    public function addQualification($data){
        $user = User::find($data['id']);
        if (isset($user)){
            $check = UserQualification::where('user_id', $data['id'])->get();
            if (Count($check) > 0){
                $updateUser = UserQualification::where('user_id', $data['id'])->update([
                    'degree_id' => $data['degree'],
                    'programme_id' => $data['programme']
                ]);

                if ($updateUser){
                    return $result = array(
                        'isSuccess' => true,
                        'message' => 'Profile Updated Successfully',
                        'status' => 200
                    );
                }else{
                    return $result = array(
                        'isSuccess' => false,
                        'message' => 'Internal Server Error',
                        'status' => 500
                    );
                }
            }else{
                $qualification =  new UserQualification();
                $qualification->user_id = $data['id'];
                $qualification->degree_id = $data['degree'];
                $qualification->programme_id = $data['programme'];
                
                if($qualification->save()){
                    return $result = array(
                        'isSuccess' => true,
                        'message' => 'Profile Updated Successfully',
                        'status' => 200
                    );
                }else{
                    return $result = array(
                        'isSuccess' => false,
                        'message' => 'Internal Server Error',
                        'status' => 500
                    );
                }
            }
        }else{
            return $result = array(
                'isSuccess' => false,
                'message' => 'User does not exists',
                'status' => 401
            );
        }
    }

    public function addPortfolio($data){
        $user = User::find($data['id']);
        if (isset($user)){
            $check = UserPortfolio::where('user_id', $data['id'])->get();
            if (count($check) > 0){
                if (isset($data['portfolio'])) {
                    $files = $data['portfolio'];
                    $destinationPath = 'portfolio/';
                    $portfolioName = date('YmdHis') . "." . $files->getClientOriginalExtension();
                    $files->move($destinationPath, $portfolioName);
                    $data['portfolio'] = "$portfolioName";
                    $updateUser = UserPortfolio::where('user_id', $data['id'])->update(['media' => $data['portfolio']]);
                    if ($updateUser){
                        return $result = array(
                            'isSuccess' => true,
                            'message' => 'Profile Updated Successfully',
                            'status' => 200
                        );
                    }else{
                        return $result = array(
                            'isSuccess' => false,
                            'message' => 'Internal Server Error',
                            'status' => 500
                        );
                    }
                }else{
                    return $result = array(
                        'isSuccess' => false,
                        'message' => 'Internal Server Error',
                        'status' => 500
                    );
                }
            }else{
                $portfolio = new UserPortfolio();
                if (isset($data['portfolio'])) {
                    $files = $data['portfolio'];
                    $destinationPath = 'portfolio/';
                    $portfolioName = date('YmdHis') . "." . $files->getClientOriginalExtension();
                    $files->move($destinationPath, $portfolioName);
                    $data['portfolio'] = "$portfolioName";
                    $portfolio->media = $data['portfolio'];
    
                    $portfolio->user_id = $data['id'];
                    if ($portfolio->save()){
                        return $result = array(
                            'isSuccess' => true,
                            'message' => 'Profile Updated Successfully',
                            'status' => 200
                        );
                    }else{
                        return $result = array(
                            'isSuccess' => false,
                            'message' => 'Internal Server Error',
                            'status' => 500
                        );
                    }
                }else{
                    return $result = array(
                        'isSuccess' => false,
                        'message' => 'Internal Server Error',
                        'status' => 500
                    );
                }
            }
        }else{
            return $result = array(
                'isSuccess' => false,
                'message' => 'User does not exists',
                'status' => 401
            );
        }
    }
}
