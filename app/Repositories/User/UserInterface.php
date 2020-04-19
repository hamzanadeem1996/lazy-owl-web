<?php
namespace App\Repositories\User;

interface UserInterface {
    public function add($data);
    public function all($role);
    public function get($id);
    public function update($data);
    public function delete($id);
    public function disabled($role);
    public function addQualification($data);
    public function addPortfolio($data);
    public function addProfileImage($data);
    public function deleteAccount($id);
}
