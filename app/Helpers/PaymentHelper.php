<?php

namespace App\Helpers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;
use Nafezly\Payments\Classes\PaymobPayment;

trait PaymentHelper
{


    public function tap($amount)
    {
        $userID = $this->getUserIDByToken(request()->bearerToken());
        $user = User::find($userID);
        $payment = new PaymobPayment();
        $res = $payment->pay(
            $amount,
            $user_id            = $user->id,
            $user_first_name    = $user->full_name,
            $user_last_name     = $user->full_name,
            $user_email         = $user->email ,
            $user_phone         = $user->phone_number,
        );

        return $res;
    }
    public function getUserIDByToken($hashedToken)
    {
        $token = PersonalAccessToken::findToken($hashedToken);
        if($token != null) {
            return $token->tokenable_id;

        } else {
            return false;
        }
    }

}
