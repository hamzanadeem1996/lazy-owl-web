<?php
namespace App\Repositories\Reviews;

interface ReviewsInterface {
    public function add($data);
    public function update($data);
    public function get($id);
    public function all($id);
    public function delete($id);
}
