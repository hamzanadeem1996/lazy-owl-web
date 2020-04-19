<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Jleon\LaravelPnotify\Notify;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Payments\PaymentsInterface;
use App\Repositories\Wallet\WalletInterface;
use App\Repositories\Transactions\TransactionsInterface;

class PaymentsController extends Controller
{
    protected $payment;
    protected $wallet;
    protected $transaction;

    public function __construct(
        PaymentsInterface        $payment,
        WalletInterface          $wallet,
        TransactionsInterface    $transaction
    ){
        $this->payment          = $payment;
        $this->wallet           = $wallet;
        $this->transaction      = $transaction;
    }

    public function addPayment(Request $request){
        $data = $request->all();
        $data['user_id'] = Auth::id();
        $data = $this->payment->add($data);

        if ($data['isSuccess'] === true){
            $walletData['user_id'] = Auth::id();
            $walletData['amount'] = 10;
            $addToWallet = $this->wallet->add($walletData);

            if ($addToWallet['isSuccess'] == true){
                Notify::success($addToWallet['message']);
            }else{
                Notify::error($addToWallet['message']);
            }

        }else{
            Notify::error($data['message']);
        }
        return redirect()->back();
    }

    public function getAllPaymentsToAdmin(){
        $payments = $this->payment->all();
        return view('admin.payment.all_payments_history', compact('payments'));
    }

    public function getAllPaymentsByUserId(){
        $userId = Auth::id();
        $userRole = Auth::user()->role;

        if($userRole == 2 || $userRole == 4){
            $payments['deposit'] = $this->payment->userPayments($userId);
            $payments['wallet'] = $this->transaction->get($userId, $userRole);
        }else if ($userRole == 3){
            $payments['wallet'] = $this->transaction->get($userId, $userRole);
        }
        
        return view('user.payments_list', compact('payments'));
    }
}
