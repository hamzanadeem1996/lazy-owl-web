<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Jleon\LaravelPnotify\Notify;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Payments\PaymentsInterface;
use App\Repositories\Wallet\WalletInterface;

class PaymentsController extends Controller
{
    protected $payment;
    protected $wallet;

    public function __construct(
        PaymentsInterface $payment,
        WalletInterface $wallet
    ){
        $this->payment = $payment;
        $this->wallet = $wallet;
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
}
