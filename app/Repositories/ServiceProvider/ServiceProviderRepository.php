<?php
namespace App\Repositories\ServiceProvider;
use App\User;
use App\UserServices;
use Illuminate\Support\Facades\Auth;

class ServiceProviderRepository implements ServiceProviderInterface {

    public function add_services($data)
    {
        //TODO: make it dynamic according service provider package
        $services_count = UserServices::where('user_id', $data['id'])->where('status', 1)->count();
        if ($services_count >= 3){
            return $response = array(
                'code' => 401,
                'isSuccess' => false,
                'message' => 'Service Add Limit Full'
            );
        }
        $x = 0;
        foreach ( $data['service_cat_id'] as $category){
            $query = UserServices::where('user_id', $data['id'])
                ->where('cat_id', $category)
                ->where('sub_cat_id', $data['service_sub_cat_id'][$x])
                ->where('status', 1)->get();
            if (count($query) > 0){
                return $response = array(
                    'code' => 401,
                    'isSuccess' => false,
                    'message' => 'Service already exists'
                );
            }
        }
        $i = 0;
        $all_services = array();
        foreach ($data['service_cat_id'] as $category){
            $raw_data = array(
              'user_id' => $data['id'],
              'cat_id' => $category,
              'sub_cat_id' => $data['service_sub_cat_id'][$i]
            );
            $all_services[] = $raw_data;
            $i++;
        }
        if (UserServices::insert($all_services)) {
            return $response = array(
                'code' => 200,
                'isSuccess' => true,
                'message' => 'Service Updated Successfully'
            );
        }else{
            return $response = array(
                'code' => 500,
                'isSuccess' => false,
                'message' => 'Internal Server Error'
            );
        }
    }

    public function delete_service($data)
    {
        if (UserServices::where('id', $data['id'])->delete()){
            return $response = array(
                'code' => 200,
                'isSuccess' => true,
                'message' => 'Service Deleted Successfully'
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
