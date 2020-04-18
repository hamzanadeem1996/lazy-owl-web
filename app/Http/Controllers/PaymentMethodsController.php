<?php

namespace App\Http\Controllers;
use App\Repositories\PaymentMethods\PaymentMethodsInterface;
use Illuminate\Http\Request;
use Jleon\LaravelPnotify\Notify;
use Illuminate\Support\Facades\Auth;

class PaymentMethodsController extends Controller
{
    protected $payment;
    public function __construct(
        PaymentMethodsInterface $payment
    ){
        $this->payment = $payment;
    }
    public function allPaymentMethodsList(){
        $payments = $this->payment->all();
        $userRole = Auth::user()->role;
        if ($userRole == 1){
            return view('admin.payment.all_payment_list', compact('payments'));
        }else{
            return view('user.payment_methods', compact('payments'));
        }
        
    }

    public function editPaymentMethod(Request $request){
        $data = $request->all();
        $payment = $this->payment->update($data);
        if ($payment['isSuccess'] == true){
            Notify::success($payment['message']);
        }else{
            Notify::error($payment['message']);
        }
        return redirect()->back();
    }
    
    public function addAccountDetails(Request $request){
        $data = $request->all();
        $data['user_id'] = Auth::id();
        $paymentMethod = $this->payment->addUserAccountDetails($data);
        if ($paymentMethod['isSuccess'] == true){
            Notify::success($paymentMethod['message']);
        }else{
            Notify::error($paymentMethod['message']);
        }
        return redirect()->back();
    }
}
