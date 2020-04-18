<?php
namespace App\Repositories\Authentication;

interface AuthenticationRepositoryInterface {
    public function login($data);
    public function register($data);
    public function forgetPassword($email);
}
