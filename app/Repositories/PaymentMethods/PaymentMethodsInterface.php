<?php
namespace App\Repositories\PaymentMethods;

interface PaymentMethodsInterface {
    public function all();
    public function update($data);
    public function addUserAccountDetails($data);
}
