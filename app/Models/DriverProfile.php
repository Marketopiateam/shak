<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DriverProfile extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    // Make relationship with user model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function car_licenses()
    {
        return $this->hasOne(DriverCarLicense::class,'driver_profile_id');
    }
    public function driver_cars()
    {
        return $this->hasOne(DriverCar::class,'driver_profile_id');
    }
    public function identity()
    {
        return $this->hasOne(DriverIdentity::class,'driver_profile_id');
    }
    public function driver_licenses()
    {
        return $this->hasOne(DriverLicense::class,'driver_profile_id');
    }
    
}
