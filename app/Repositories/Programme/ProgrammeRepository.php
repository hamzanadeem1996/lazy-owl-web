<?php
namespace App\Repositories\Programme;
use App\DegreeProgramme;

class ProgrammeRepository implements ProgrammeInterface {

    public function add($data)
    {
        $check = DegreeProgramme::where('title', $data['title'])->where('degree_id', $data['degree_id'])->get();
        if (count($check) > 0){
            return $response = array([
                'isSuccess' => false,
                'message'    => 'Programme already exists',
                'status'     => 401
            ]);
        }else{
            $prog = new DegreeProgramme();
            $prog->degree_id = $data['degree_id'];
            $prog->title = $data['title'];
            if($prog->save()){
                return $response = array([
                    'isSuccess' => true,
                    'message'    => 'Programme added successfully',
                    'status'     => 200
                ]);
            }else{
                return $response = array([
                    'isSuccess' => false,
                    'message'    => 'Internal Server Error',
                    'status'     => 401
                ]);
            }
        }
    }

    public function update($data)
    {
        $check = DegreeProgramme::where('title', $data['title'])->get();
//        return count($check);
        if (count($check) > 0){
            return $response = array([
                'isSuccess' => false,
                'message'    => 'Title already exists',
                'status'     => 401
            ]);
        }else{
            $prog = DegreeProgramme::find($data['id']);
            $prog->degree_id = $data['degree_id'];
            $prog->title = $data['title'];
            if($prog->save()){
                return $response = array([
                    'isSuccess' => true,
                    'message'    => 'Programme updated successfully',
                    'status'     => 200
                ]);
            }else{
                return $response = array([
                    'isSuccess' => false,
                    'message'    => 'Internal Server Error',
                    'status'     => 401
                ]);
            }
        }
    }


    public function all()
    {
        return DegreeProgramme::all();
    }

    public function delete($id)
    {
        $programme = DegreeProgramme::find($id);
        if ($programme->status == 1){
            $programme->status = 0;
            if ($programme->save()){
                return $result = array(
                    'isSuccess' => true,
                    'message' => 'Programme disabled successfully'
                );
            }else{
                return $result = array(
                    'isSuccess' => false,
                    'message' => 'Internal Server Error'
                );
            }
        }else{
            $programme->status = 1;
            if ($programme->save()){
                return $result = array(
                    'isSuccess' => true,
                    'message' => 'Programme enabled successfully'
                );
            }else{
                return $result = array(
                    'isSuccess' => false,
                    'message' => 'Internal Server Error'
                );
            }
        }
    }


    public function get($id)
    {
        return DegreeProgramme::find($id);
    }

    public function getDisabled(){
        return DegreeProgramme::where('status', 0)->get();
    }

    public function getActive() {
        return DegreeProgramme::where('status', 1)->get();
    }
}
