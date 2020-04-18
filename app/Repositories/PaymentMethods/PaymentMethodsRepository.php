<?php
namespace App\Repositories\PaymentMethods;
use App\PaymentMethods;

class PaymentMethodsRepository implements PaymentMethodsInterface {

    public function all(){
        $paymentMethods = PaymentMethods::where('status', 1)->get();
        return $paymentMethods;
    }

    public function update($data){
        $payment = PaymentMethods::find($data['id']);
        if (isset($payment)){
            $payment->acc_number = $data['acc_number'];
            $payment->owner = $data['owner'];
            if ($payment->save()){
                return $response = array(
                    'isSuccess' => true,
                    'message' => 'Payment Method updated successfully',
                    'status' => 200
                );
            }else{
                return $response = array(
                    'isSuccess' => false,
                    'message' => 'Internal Server Error',
                    'status' => 500
                );
            }
        }else{
            return $response = array(
                'isSuccess' => false,
                'message' => 'Payment Method Not Found',
                'status' => 404
            );
        }
    }
}
?>