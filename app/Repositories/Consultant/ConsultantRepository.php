<?php
namespace App\Repositories\Consultant;
use App\UserExperience;

class ConsultantRepository implements ConsultantInterface {

    public function add_experience($data)
    {
        //TODO: make it dynamic according consultant package
        $experience_count = UserExperience::where('user_id', $data['id'])->where('status', 1)->count();
        if ($experience_count >= 3){
            return $response = array(
                'code' => 401,
                'isSuccess' => false,
                'message' => 'Experience Add Limit Full'
            );
        }
        $x = 0;
        foreach ( $data['experience_cat_id'] as $experience){
            $query = UserExperience::where('user_id', $data['id'])
                ->where('cat_id', $experience)
                ->where('sub_cat_id', $data['experience_sub_cat_id'][$x])
                ->where('status', 1)->get();
            if (count($query) > 0){
                return $response = array(
                    'code' => 401,
                    'isSuccess' => false,
                    'message' => 'Experience already exists'
                );
            }
        }
        $i = 0;
        $all_experience = array();
        foreach ($data['experience_cat_id'] as $experience){
            $raw_data = array(
              'user_id' => $data['id'],
              'cat_id' => $experience,
              'sub_cat_id' => $data['experience_sub_cat_id'][$i]
            );
            $all_experience[] = $raw_data;
            $i++;
        }
        if (UserExperience::insert($all_experience)) {
            return $response = array(
                'code' => 200,
                'isSuccess' => true,
                'message' => 'Experience Updated Successfully'
            );
        }else{
            return $response = array(
                'code' => 500,
                'isSuccess' => false,
                'message' => 'Internal Server Error'
            );
        }
    }

    public function delete_experience($data)
    {
        if (UserExperience::where('id', $data['id'])->delete()){
            return $response = array(
                'code' => 200,
                'isSuccess' => true,
                'message' => 'Experience Deleted Successfully'
            );
        }else{
            return $response = array(
                'code' => 401,
                'isSuccess' => false,
                'message' => 'Internal Server Error'
            );
        }
    }
}
