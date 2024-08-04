<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Helpers\PaymentHelper;
use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
        $redirect_url   = $payment['redirect_url'];
        return    resp($redirect_url, 'success', 200);

    }

    public function payment_verify(Request $request) 
    {
        dd($request->all());
    }
}
