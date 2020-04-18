<?php
namespace App\Repositories\Programme;
interface ProgrammeInterface {
    public function add($data);
    public function update($data);
    public function get($id);
    public function delete($id);
    public function all();
    public function getDisabled();
    public function getActive();
}
