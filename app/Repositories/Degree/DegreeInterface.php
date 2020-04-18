<?php
namespace App\Repositories\Degree;

interface DegreeInterface {
    public function add($data);
    public function update($data);
    public function get($id);
    public function all();
    public function delete($id);
    public function getActive();
    public function getDisabled();
    public function getProgrammes($id);
}



