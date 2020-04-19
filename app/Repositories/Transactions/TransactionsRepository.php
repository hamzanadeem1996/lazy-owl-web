<?php
namespace App\Repositories\Transactions;
use App\Transactions;

class TransactionsRepository implements TransactionsInterface {

    public function add($data){
        
        $tansaction = new Transactions();
        $tansaction->user_id    = $data['user_id'];
        $tansaction->to_user_id = $data['to_user_id'];
        $tansaction->amount     = $data['amount'];
        $tansaction->project_id = $data['project_id'];
        $tansaction->paid     = $data['paid'];

        if ($tansaction->save()){
            return $response = array(
                'status' => 200,
                'isSuccess' => true,
                'message'   => 'Transaction added successfully'
            );
        }else{
            return $response = array(
                'status' => 500,
                'isSuccess' => false,
                'message'   => 'Internal Server Error'
            );
        }
    }

    public function get($userId, $userRole){
        $transactions = null;
        if ($userRole == 2){
            $transactions = Transactions::where('user_id', $userId)->where('paid', 1)->get();
        }else if($userRole == 3){
            $tansactions = Transactions::where('to_user_id', $userId)->where('paid', 0)->get();
        }else{
            $paid = Transactions::where('user_id', $userId)->where('paid', 1)->get();
            $get = Transactions::where('to_user_id', $userId)->where('paid', 0)->get();
            $transactions = array();
            foreach($paid as $item){
                $transactions[] = $item;
            }
            foreach($get as $item){
                $transactions[] = $item;
            }
        }
        return $transactions;
    }
}