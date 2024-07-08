<?php

namespace App\Models;

use Hash;
use Carbon\Carbon;
use DateTimeInterface;
use App\Models\Reviews;
use Laravel\Sanctum\HasApiTokens;
use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Translation\HasLocalePreference;

class User extends Authenticatable implements HasLocalePreference
{
    use HasFactory, HasAdvancedFilter, Notifiable, SoftDeletes, HasApiTokens;

    public $table = 'users';
    protected $guarded = [];
    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected $hidden = [
        'remember_token',
        'password',
    ];

    protected $dates = [
        'email_verified_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];


    public $orderable = [
        'id',
        'name',
        'email',
        'email_verified_at',
        'locale',
        'country_code',
        'fcm_token',
        'is_active',
        'login_type',
        'phone_number',
        'profile_pic',
        'reviews_count',
        'reviews_sum',
        'wallet_amount',
    ];

    public $filterable = [
        'id',
        'name',
        'email',
        'email_verified_at',
        'roles.title',
        'locale',
        'country_code',
        'fcm_token',
        'login_type',
        'phone_number',
        'profile_pic',
        'reviews_count',
        'reviews_sum',
        'wallet_amount',
    ];
    public function getImageurlAttribute()
    {
        if ($this->profile_pic == null) {

            return '';
        }
        return path($this->id, 'users')  . $this->profile_pic;
    }
    public static function findToken($token)
    {
        $token = str_replace('Bearer ', '', $token); // Remove 'Bearer ' prefix if it exists
        $accessToken = PersonalAccessToken::findToken($token);

        if ($accessToken) {
            return $accessToken->tokenable; // Assuming tokenable is the User model
        }

        return null;
    }
    public function getIsAdminAttribute()
    {
        return $this->roles()->where('title', 'Admin')->exists();
    }
    public function review()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }
    public function scopeAdmins()
    {
        return $this->whereHas('roles', fn ($q) => $q->where('title', 'Admin'));
    }

    public function preferredLocale()
    {
        return $this->locale;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getEmailVerifiedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('project.datetime_format')) : null;
    }

    public function setEmailVerifiedAtAttribute($value)
    {
        $this->attributes['email_verified_at'] = $value ? Carbon::createFromFormat(config('project.datetime_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function setPasswordAttribute($input)
    {
        if ($input) {
            $this->attributes['password'] = Hash::needsRehash($input) ? Hash::make($input) : $input;
        }
    }
    public function otp()
    {
        return $this->hasMany(Otp::class);
    }
    public function profile()
    {
        return $this->hasOne(DriverProfile::class);
    }
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function getCreatedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('project.datetime_format')) : null;
    }

    public function getUpdatedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('project.datetime_format')) : null;
    }

    public function getDeletedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('project.datetime_format')) : null;
    }
     
}
