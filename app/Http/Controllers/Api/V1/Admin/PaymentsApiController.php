<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Helpers\PaymentHelper;
use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Nafezly\Payments\Classes\PaymobPayment;

class PaymentsApiController extends Controller
{
    use PaymentHelper;
    public function get_payments(Request $request)
    {
       $payment =  PaymentMethod::get();
        return    resp($payment, 'success', 200);
    }
    public function charge_wallet(Request $request)
    {
        $payment        = $this->tap($request->value); 
        dd($payment);      
        $redirect_url   = $payment['redirect_url'];
        return    resp($redirect_url, 'success', 200);

    }

    public function payment_verify(Request $request) 
    {
        $payment = new PaymobPayment();
        $response = $payment->verify($request);
        dd($response);
    }
}
