<?php
namespace App\Repositories\Payments;

interface PaymentsInterface {
    public function add($data);
    public function all();
    public function userPayments($id);
}