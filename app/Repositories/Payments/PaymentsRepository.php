<?php
namespace App\Repositories\Payments;
use App\Payments;
use App\Wallet;
use App\User;
use Illuminate\Support\Facades\Auth;

class PaymentsRepository implements PaymentsInterface {
    
    public function add($data){
        $user = User::find($data['user_id']);
        // $apiKey = env('STRIPE_PRIVATE_KEY');
        $apiKey = 'sk_test_GHGALBU9AOnazZwaqIKobtdb00OCXtKMpH';
        \Stripe\Stripe::setApiKey($apiKey);
        
        $token = $data['stripeToken'];
        // $charge = \Stripe\Charge::create([
        //     'amount' => env('STRIPE_ONE_TIME_PAYMENT'),
        //     'currency' => env('STRIPE_CURRENCY'),
        //     'description' => 'Lazy Owl Wallet Deposit', ? $charge['billing_details']['name'] : $user['email']
        //     'source' => $token
        // ]);
        $charge = \Stripe\Charge::create([
            'amount' => 1000,
            'currency' => 'usd',
            'description' => 'Lazy Owl Wallet Deposit',
            'source' => $token
        ]);
        
        if ($charge){
            $payment = new Payments();
            $payment->user_id           = $data['user_id'];
            $payment->transaction_id    = $charge['id'];
            $payment->amount            = $charge['amount'];
            $payment->email             = $charge['billing_details']['name'] ? $charge['billing_details']['name'] : $user['email'];
            $payment->receipt_url       = $charge['receipt_url'];
            $payment->refund_url        = $charge['refunds']['url'];
            $payment->last_four_of_card = $charge['source']['last4'];
            $payment->card_exp_year     = $charge['source']['exp_year'];
            $payment->card_exp_month    = $charge['source']['exp_month'];
            $payment->card_id           = $charge['source']['id'];
            $payment->card_brand        = $charge['source']['brand'];

            if ($payment->save()){
                return $response = array(
                    'status' => 200,
                    'isSuccess' => true,
                    'message'   => 'Payment added to wallet successfully'
                );
            }else{
                return $response = array(
                    'status' => 500,
                    'isSuccess' => false,
                    'message'   => 'Internal Server Error'
                );
            }
        }else{
            return $response = array(
                'status' => 500,
                'isSuccess' => false,
                'message'   => 'Internal Server Error'
            );
        }
    }

    public function all(){
        return Payments::all();
    }

    public function userPayments($id){
        return Payments::where('user_id', $id)->get();
    }
}