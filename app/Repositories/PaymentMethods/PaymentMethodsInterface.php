<?php
namespace App\Repositories\PaymentMethods;

interface PaymentMethodsInterface {
    public function all();
    public function update($data);
}
?>