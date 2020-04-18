<?php
namespace App\Repositories\Reviews;
use App\Reviews;

class ReviewsRepository implements ReviewsInterface {

    public function add($data)
    {
        // TODO: Implement add() method.
    }

    public function update($data)
    {
        // TODO: Implement update() method.
    }

    public function get($id)
    {
        // TODO: Implement get() method.
    }

    public function all($id)
    {
        // TODO: Implement all() method.
    }

    public function delete($id)
    {
        $review = Reviews::where('id', $id)->delete();
        if ($review){
            return $data = array(
                'isSuccess' => true,
                'message' => 'Comment deleted successfully'
            );
        }else{
            return $data = array(
                'isSuccess' => false,
                'message' => 'Internal Server Error'
            );
        }
    }
}
