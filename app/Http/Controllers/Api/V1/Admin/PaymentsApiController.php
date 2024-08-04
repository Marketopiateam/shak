<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Helpers\PaymentHelper;
use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use App\Models\PaymentTransaction;
use App\Models\User;
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
        $userID = $this->getUserIDByToken(request()->bearerToken());
        PaymentTransaction::create([
            'payment_id'        => $payment['payment_id'],
            'pending'           => 1,
            'success'           => 0,
            'payment_method'    => 'card',
            'payment_gateway'   => 'paymob',
            'userID'            => $userID
            
        ]);
        $redirect_url   = $payment['redirect_url'];
        return    resp($redirect_url, 'success', 200);

    }

    public function payment_verify(Request $request) 
    {
        $payment    = new PaymobPayment();
        $response       = $payment->verify($request);
        $Transaction    = PaymentTransaction::where('payment_id','=',$response['payment_id'])->first();
        $Transaction->update([
            'pending'   => (strtolower($response['process_data']['pending']) === 'false') ? false : true ,
            'success'   => (strtolower($response['process_data']['success']) === 'false') ? false : true ,
            'amount'    => $response['process_data']['amount_cents'] / 100,
        ]);
        $user = User::find($Transaction->userID);
        $user->update([
            'wallet_amount' => $user->wallet_amount + ($response['process_data']['amount_cents'] / 100)
        ]);
        return response()->json([
            'success'   => $response['process_data']['success']
        ]);
    }
}
