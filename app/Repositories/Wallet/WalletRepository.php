<?php
namespace App\Repositories\Wallet;
use App\Wallet;

class WalletRepository implements WalletInterface {

    public function add($data){
        $balance = $this->get($data['user_id']);
        $wallet = null;

        if (count($balance) > 0){
            $wallet = Wallet::find($balance[0]['id']);
            $wallet->amount = $balance[0]['amount'] + $data['amount'];
        }else{
            $wallet = new Wallet();
            $wallet->user_id = $data['user_id'];
            $wallet->amount = $data['amount'];
        }
        
        if ($wallet->save()){
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
    }

    public function get($id){
        return Wallet::where('user_id', $id)->get();
    }

    public function minus($data){
        $user = $this->get($data['user_id']);
        if (count($user) > 0){
            $wallet = Wallet::find($user[0]['id']);
            $wallet->amount = $user[0]['amount'] - $data['amount'];

            if ($wallet->save()){
                return $response = array(
                    'status' => 200,
                    'isSuccess' => true,
                    'message'   => 'Payment successfull'
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
                'status' => 400,
                'isSuccess' => false,
                'message'   => 'User does not exists'
            );
        }
    }
}