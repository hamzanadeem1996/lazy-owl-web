<?php
namespace App\Repositories\Admin;

interface AdminRepositoryInterface {
    public function validation();
    public function get_admin_profile();
    public function passwordUpdate($data);
}
