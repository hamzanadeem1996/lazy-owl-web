<?php
namespace App\Repositories\Category;

interface CategoryInterface {
    public function add($data);
    public function all();
    public function get($id);
    public function update($data);
    public function delete($id);
    public function disabled();
}
