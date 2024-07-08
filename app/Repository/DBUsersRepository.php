<?php

namespace App\Repository;

use App\Models\Otp;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use App\Traits\MapsProcessing;
use App\Traits\ImageProcessing;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\CityResource;
use App\Http\Resources\UserResource;

use Illuminate\Support\Facades\Auth;

use App\Http\Resources\AddressResource;
use App\Http\Resources\CountryResource;
use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\LoginUserResource;
use App\Models\Marketopia\MarketopiaCity;
use App\Models\Marketopia\MarketopiaCountry;
use App\Repositoryinterface\UsersRepositoryinterface;

class DBUsersRepository implements UsersRepositoryinterface
{
    use ImageProcessing, MapsProcessing;

    protected Model $model;
    protected $request;

    public function __construct(User $model, Request $request)
    {
        $this->model = $model;
        $this->request = $request;
    }

    public function verify_otp()
    {
        $otp =  Otp::where(['otp' => $this->request->code, 'verify' => 0])->orderBy('created_at', 'desc')->first();
        if ($otp == null) {
            return Resp('', __('messages.code_not_correct'), 400, true);
        }

        $user = User::where(['phone_number' => $otp->phone])->with('profile')->first();
        if ($user != null) {
            $user->token = $user->createToken($user->name . '-AuthToken')->plainTextToken;
            return Resp(new UserResource($user), __('messages.success_login'), 200, true);
        } else {
            return Resp('', __('messages.notfound'), 200, false);
        }
    }
    public function send_otp()
    {
        $otp = rand(123456, 99999);
        $otp = '111111';
        Otp::create(['phone' => $this->request->phone, 'otp' => $otp]);
        return Resp('', __('messages.success_send_otp'), 200, true);
    }
    public function signup()
    {

        DB::beginTransaction();
        try {
            $data = [
                'full_name'         => $this->request->name,
                'email'             => $this->request->email ?? null,
                'phone_number'      => $this->request->phone,
                'fcm_token'         => $this->request->fcm_token,
                'country_id'        => $this->request->country_id,
                'city_id'           => $this->request->city_id,
                'wallet_amount'     => 0,

            ];
            $user =  User::create($data);

            if ($this->request->image) {
                $dataX = $this->saveImageAndThumbnail($this->request->image, false, $user->id, 'users');
                $user->profile_pic =  $dataX['image'];
                $user->save();
            }
            $user->token = $user->createToken($user->full_name . '-AuthToken')->plainTextToken;
            if ($user != null) {
                DB::commit();
                return Resp(new UserResource($user), __('messages.success_signup'), 200, true);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return Resp('', $e->getMessage(), 404, true);
            // return false;
        }
    }
    public function profile()
    {
        $user = Auth::user();

          if ($user != null) {
            return Resp(new UserResource($user), __('messages.success'), 200, true);
        }
        return Resp('', 'error', 402, true);
    }

    public function country()
    {
        $country =  MarketopiaCountry::get();
          if ($country != null) {
            return Resp(CountryResource::collection($country), __('messages.success'), 200, true);
        }
        return Resp('', 'error', 402, true);
    }

    public function city($id)
    {
        $citys =  MarketopiaCity::where('country_id',$id)->get();
          if ($citys != null) {
            return Resp(CityResource::collection($citys), __('messages.success'), 200, true);
        }
        return Resp('', 'error', 402, true);
    }



    public function profile_update()
    {

        $id = Auth::user()->id;
        $user =  User::find($id);
        if ($this->request->has('name')) {
            $user->full_name = $this->request->name;
        }
        if ($this->request->has('email')) {
            $user->email = $this->request->email;
        }
        if ($this->request->has('country_id')) {
            $user->country_id = $this->request->country_id;
        }
        if ($this->request->has('city_id')) {
            $user->city_id = $this->request->city_id;
        }
        if ($this->request->has('image')) {
            if ($user->profile_pic != null) {
                $this->deletefile($user->profile_pic, $user->id, 'users');
            }

            $dataX = $this->saveImageAndThumbnail($this->request->image, false, $user->id, 'users');

            $user->profile_pic =  $dataX['image'];
        }
        $user->save();
        if ($user != null) {
            return Resp(new UserResource($user), __('messages.success_update_profile'), 200, true);
        }
        return Resp('', 'error', 402, true);
    }

    // public function credentials($data)
    // {
    //     $credentials = [
    //         'phone' => $data['phone'],
    //         'password' =>  $data['password'],
    //     ];
    //     if ($token = Auth::attempt($credentials)) {
    //         $user = auth('api')->user();
    //     } else {
    //         return Resp('', 'Invalid Credentials', 404, false);
    //     }

    //     if ($token == null) {
    //         return Resp('', 'User Not found', 404, false);
    //     }
    //     // $user =  auth('api')->user();
    //     $user->token = $token;
    //     $data =  new LoginUserResource($user);
    //     return Resp($data, 'Success', 200, true);
    // }
    // public function profile_details()
    // {
    //     $id = Auth::user()->id;
    //     $user =  User::find($id);
    //     if ($user != null) {
    //         $data =  new LoginUserResource($user);
    //         return Resp($data, 'Success', 200, true);
    //     }
    //     return Resp('', 'error', 402, true);
    // }
    // public function  forgotpassword($request)
    // {
    //     $user =  $this->model->where('phone', $this->request->phone)->first();
    //     return Resp('', 'Send Code Success', 200, true);
    // }
    // public function  verificationcode($request)
    // {
    //     if ($this->request->code == '11111') {
    //         return Resp('', 'Success', 200, true);
    //     } else {
    //         return Resp('', 'invalid Code', 400, false);
    //     }
    // }
    // public function  resend_code($request)
    // {
    //     return Resp('', 'Send Code Success', 200, true);
    // }
    // public function  change_password($request)
    // {
    //     $user =  $this->model->where('phone', $this->request->phone)->first();
    //     $user->password = $this->request->password;
    //     $user->save();
    //     $data= ['phone'=>$user->phone,'password'=>$this->request->password];
    //     return  $this->credentials($data);
    //     }
}
