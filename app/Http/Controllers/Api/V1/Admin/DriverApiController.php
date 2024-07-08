<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Models\DriverCar;
use Illuminate\Http\Request;
use App\Models\DriverLicense;
use App\Models\DriverProfile;
use Illuminate\Http\Response;
use App\Models\DriverIdentity;
use App\Helpers\ResponseHelper;
use App\Models\DriverCarLicense;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Traits\ImageProcessing;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class DriverApiController extends Controller
{
    use ResponseHelper,ImageProcessing;
    public function driver_registration(Request $request)
    {

        DB::beginTransaction();

        try {
            $user_id = Auth::user()->id;



            if ($request->has('criminal_record_image')) {
                $criminal_record_image = $this->saveImageAndThumbnail($request->criminal_record_image, false, $user_id, 'DriverLicense');

            }
            if ($request->has('front_identity_image')) {
                $front_identity_image = $this->saveImageAndThumbnail($request->front_identity_image, false, $user_id, 'DriverLicense');
            }
            if ($request->has('back_identity_image')) {
                $back_identity_image = $this->saveImageAndThumbnail($request->back_identity_image, false, $user_id, 'DriverLicense');
            }
            if ($request->has('driver_image_with_id')) {
                $driver_image_with_id = $this->saveImageAndThumbnail($request->driver_image_with_id, false, $user_id, 'DriverLicense');
            }
            if ($request->has('front_license_image')) {
                $front_license_image = $this->saveImageAndThumbnail($request->front_license_image, false, $user_id, 'DriverLicense');
            }
            if ($request->has('back_license_image')) {
                $back_license_image = $this->saveImageAndThumbnail($request->back_license_image, false, $user_id, 'DriverLicense');
            }
            if ($request->has('driver_with_license_image')) {
                $driver_with_license_image = $this->saveImageAndThumbnail($request->driver_with_license_image, false, $user_id, 'DriverLicense');
            }
            if ($request->has('car_front_license_image')) {
                $car_front_license_image = $this->saveImageAndThumbnail($request->car_front_license_image, false, $user_id, 'DriverLicense');
            }
            if ($request->has('car_back_license_image')) {
                $car_back_license_image = $this->saveImageAndThumbnail($request->car_back_license_image, false, $user_id, 'DriverLicense');
            }
            if ($request->has('car_driver_with_license_image')) {
                $car_driver_with_license_image = $this->saveImageAndThumbnail($request->car_driver_with_license_image, false, $user_id, 'DriverLicense');
            }

            $DriverProfile =  DriverProfile::create([
                'user_id' => $user_id, 
                'birth_date' => $request->birth_date,  
                'id_number' => $request->id_number,   
                'criminal_record_image' => $criminal_record_image['image'],
                'expiry_date' => $request->criminal_expiry_date,
                'service_id' => $request->service_id
            ]);

            $DriverIdentity = DriverIdentity::create(['id_number' => $request->id_number,    'front_identity_image' =>  $front_identity_image['image'], 'back_identity_image' => $back_identity_image['image'],    'expiry_date' => $request->expiry_date,    'driver_image_with_id' => $driver_image_with_id['image'],       'driver_profile_id' => $DriverProfile->id,]);
            $DriverCar =      DriverCar::create(['driver_profile_id' => $DriverProfile->id,    'car_brand_id' => $request->car_brand_id,    'car_model_id' => $request->car_model_id,    'color' => $request->color,    'release_year' => $request->release_year]);
            $DriverLicense =  DriverLicense::create(['front_license_image' =>  $front_license_image['image'],   'back_license_image' => $back_license_image['image'], 'driver_with_license_image' => $driver_with_license_image['image'],    'expiry_date' => $request->license_expiry_date, 'driver_profile_id' => $DriverProfile->id]);
            $DriverCarLicense =  DriverCarLicense::create(['front_license_image' => $car_front_license_image['image'],   'back_license_image' => $car_back_license_image['image'], 'driver_with_license_image' => $car_driver_with_license_image['image'],    'expiry_date' => $request->car_expiry_date,   'driver_profile_id' => $DriverProfile->id, 'driver_car_id' => $DriverCar->id]);
            DB::commit();
            return $this->apiResponseHandler(200, true, 'succes');
        } catch (\Exception $e) {
            DB::rollback();
            return $this->apiResponseHandler(400, false, 'error',$e->getMessage());
        }
    }
    public function change_service(Request $request)
    {
        $driverID = $this->getUserIDByToken(request()->bearerToken());
        DriverProfile::where([
            'service_id'=> $request->service_id
        ]);
        return $this->apiResponseHandler(200, true, 'success');

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
