<?php
namespace App\Repositories\PaymentMethods;
use App\PaymentMethods;
use App\UserBankAcc;

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

    public function addUserAccountDetails($data){
        $check = UserBankAcc::where('user_id', $data['user_id'])->where('payment_method_id', $data['payment_method_id'])->get();
        if (count($check) > 0){
            $update = null;

            if ($data['payment_method_id'] == 4){
                $update = UserBankAcc::where('user_id', $data['user_id'])
                    ->where('payment_method_id', $data['payment_method_id'])
                    ->update([
                        'bank_name'     => $data['bank_name'],
                        'acc_title'     => $data['acc_title'],
                        'acc_number'    => $data['acc_number'],
                        'branch_code'   => $data['branch_code']
                    ]);
            }else{
                $update = UserBankAcc::where('user_id', $data['user_id'])
                ->where('payment_method_id', $data['payment_method_id'])
                ->update([
                    'acc_number'    => $data['acc_number']
                ]);
            }
            if ($update){
                return $response = array(
                    'isSuccess' => true,
                    'message' => 'Payment Details Added successfully',
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
            $account = new UserBankAcc();
            if ($data['payment_method_id'] == 4){
                $account->user_id = $data['user_id'];
                $account->payment_method_id = $data['payment_method_id'];
                $account->bank_name = $data['bank_name'];
                $account->acc_title = $data['acc_title'];
                $account->acc_number = $data['acc_number'];
                $account->branch_code = $data['branch_code'];
            }else{
                $account->user_id = $data['user_id'];
                $account->payment_method_id = $data['payment_method_id'];
                $account->acc_number = $data['acc_number'];
            }
            if ($account->save()){
                return $response = array(
                    'isSuccess' => true,
                    'message' => 'Payment Details Added successfully',
                    'status' => 200
                );
            }else{
                return $response = array(
                    'isSuccess' => false,
                    'message' => 'Internal Server Error',
                    'status' => 500
                );
            }
        }
    }

    public function getUserCardDetails($userId) {
        return UserBankAcc::where('user_id', $userId)->get();
    }
}
