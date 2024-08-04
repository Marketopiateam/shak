<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Resources\UserDocsResource;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\SignUp;
use App\Models\PaymentMethod;
use App\Helpers\PaymentHelper;
use App\Traits\MapsProcessing;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\AddAddressRequest;
use App\Repositoryinterface\UsersRepositoryinterface;
use Laravel\Sanctum\PersonalAccessToken;

class AuthenticationController extends Controller
{
    use PaymentHelper;
    private $userRepositry;
    public function __construct(UsersRepositoryinterface $userRepositry)
    {
        $this->userRepositry = $userRepositry;
    }
    public function settings()
    {
        return Resp(Setting::first(), 'success');
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

    public function signup()
    {
        return $this->userRepositry->signup();
    }
    public function city($id)
    {
        return $this->userRepositry->city($id);
    }
    public function country()
    {
        return $this->userRepositry->country();
    }
    public function send_otp()
    {
        return $this->userRepositry->send_otp();
    }
    public function verify_otp()
    {
        return $this->userRepositry->verify_otp();
    }
    public function profile()
    {
        return $this->userRepositry->profile();
    }
    public function profile_update()
    {
        return $this->userRepositry->profile_update();
    }
    public function toggle_online($online)
    {
        $user  = User::find(Auth::user()->id);
        $user->update(['is_online' => $online]);
        return  Resp(['is_online' => $user->is_online], 'success', 200, true);
    }

    
    public function get_docs()
    {
        $driverID = $this->getUserIDByToken(request()->bearerToken());
        $user  = User::with('profile', 'profile.car_licenses', 'profile.identity', 'profile.driver_licenses', 'profile.driver_cars')->find($driverID);
        return Resp(new UserDocsResource($user), 'success');

    }
}
