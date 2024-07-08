<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PaymentsApiController extends Controller
{
    public function get_payments(Request $request)
    {
       $payment =  PaymentMethod::get();
        return    resp($payment, 'success', 200);
    }
}
