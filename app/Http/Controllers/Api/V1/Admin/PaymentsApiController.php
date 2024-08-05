<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Helpers\PaymentHelper;
use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use App\Models\PaymentTransaction;
use App\Models\User;
use App\Models\WithdrawRequest;
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
            'status'           => 'pending',
            'success'           => 0,
            'amount'            => $request->value,
            'payment_method'    => 'card',
            'payment_gateway'   => 'paymob',
            'userID'            => $userID
            
        ]);
        $redirect_url   = $payment['redirect_url'];
        return    resp($redirect_url, 'success', 200);

    }

    public function payment_verify(Request $request) 
    {
        $payment        = new PaymobPayment();
        $response       = $payment->verify($request);
        $status         = (strtolower($response['process_data']['success']) === 'false') ? false : true;
        $Transaction    = PaymentTransaction::where('payment_id','=',$response['payment_id'])->first();
        if($status) {
            $Transaction->update([
                'status'           => 'success',
                'success'   => (strtolower($response['process_data']['success']) === 'false') ? false : true ,
            ]);
            $user = User::find($Transaction->userID);
            $user->update([
                'wallet_amount' => $user->wallet_amount + ($response['process_data']['amount_cents'] / 100)
            ]);
            return response()->json([
                'success'   => $response['process_data']['success']
            ]);
        } else {
            $Transaction->update([
                'status'           => 'failed',
                'success'   => (strtolower($response['process_data']['success']) === 'false') ? false : true ,
            ]);
            return response()->json([
                'success'   => $status
            ]);
        }   
    }
    public function transactions() 
    {
        $userID             = $this->getUserIDByToken(request()->bearerToken());
        $transactions       = PaymentTransaction::where('userID','=',$userID)->get();
        return    resp($transactions, 'success', 200);

    }
    public function withdraw_request(Request $request) 
    {
        $userID         = $this->getUserIDByToken(request()->bearerToken());
        $user           = User::find($userID); 
        $transactions   = WithdrawRequest::create([
            'amount'    => $request->value,
            'userID'    => $userID
        ]);
        $user->update([
            'wallet_amount' => $user->wallet_amount - $request->value,
            'pending_wallet' => $user->pending_wallet + $request->value,
        ]);

        return    resp($transactions, 'success', 200);

    }
    public function get_withdraw_request() 
    {
        $userID         = $this->getUserIDByToken(request()->bearerToken());
        $user           = User::find($userID); 
        $transactions   = WithdrawRequest::where('userID', '=', $userID)->get();
        return    resp($transactions, 'success', 200);

    }
}
