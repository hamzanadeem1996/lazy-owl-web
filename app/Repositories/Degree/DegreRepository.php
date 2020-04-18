<?php
namespace App\Repositories\Degree;
use App\Degree;
use App\DegreeProgramme;

class DegreRepository implements DegreeInterface
{

    public function add($data)
    {
        $check = Degree::where('title', $data['title'])->get();
        if (count($check) > 0) {
            return $response = array(
                'isSuccess' => false,
                'message' => 'Title already exists',
                'status' => 401
            );
        } else {
            $degree = new Degree();
            $degree->title = $data['title'];
            if ($degree->save()) {
                return $response = array(
                    'isSuccess' => true,
                    'message' => 'Degree added successfully',
                    'status' => 200
                );
            } else {
                return $response = array(
                    'isSuccess' => false,
                    'message' => 'Internal Server Error',
                    'status' => 401
                );
            }
        }
    }

    public function get($id)
    {
        return Degree::find($id);
    }


    public function delete($id)
    {
        $degree = Degree::find($id);
        if ($degree->status == 1){
            $degree->status = 0;
            if ($degree->save()){
                return $result = array(
                    'isSuccess' => true,
                    'message' => 'Degree disabled successfully'
                );
            }else{
                return $result = array(
                    'isSuccess' => false,
                    'message' => 'Internal Server Error'
                );
            }
        }else{
            $degree->status = 1;
            if ($degree->save()){
                return $result = array(
                    'isSuccess' => true,
                    'message' => 'Degree enabled successfully'
                );
            }else{
                return $result = array(
                    'isSuccess' => false,
                    'message' => 'Internal Server Error'
                );
            }
        }
    }


    public function all()
    {
        return Degree::all();
    }

    public function getActive()
    {
        return Degree::where('status', 1)->get();
    }

    public function getDisabled()
    {
        return Degree::where('status', 0)->get();
    }

    public function update($data)
    {
        $check = Degree::where('title', $data['title'])->get();
//        return count($check);
        if (count($check) > 0) {
            return $response = array([
                'isSuccess' => false,
                'message' => 'Title already exists',
                'status' => 401
            ]);
        } else {
            $degree = Degree::find($data['degree_id']);
            $degree->title = $data['title'];
            if ($degree->save()) {
                return $response = array([
                    'isSuccess' => true,
                    'message' => 'Degree updated successfully',
                    'status' => 200
                ]);
            } else {
                return $response = array([
                    'isSuccess' => false,
                    'message' => 'Internal Server Error',
                    'status' => 401
                ]);
            }
        }
    }

    public function getProgrammes($id){
        $programmes = DegreeProgramme::where('degree_id', $id)->get();
        return $programmes;
    }
}
