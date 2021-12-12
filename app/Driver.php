<?php

namespace App;

use App\Models\Notification;
use App\Models\Service;
use App\Models\TripType;
use App\Models\VehicleType;
use App\Notifications\UserResetPasswordNotification;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Driver extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, Notifiable, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
    protected $appends = ['is_verified', 'create_date', 'is_available_text', 'trip_type_name', 'vehicle_type_name'];

    protected $guard = 'driver_api';
    protected $with = 'services';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
/*    protected $hidden = [
        'password', 'remember_token', 'twitter_id', 'google_id', 'email_verified_at',
        'created_at', 'updated_at', 'deleted_at', 'service_id', 'driver_id', 'trip_type_id',
        'vehicle_type_id', 'tripType', 'vehicleType', 'services'
    ];*/

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new UserResetPasswordNotification($token));
    }
    public function sendEmailVerificationNotification()
    {
//        $this->notify(new UserResetPasswordNotification($token));
    }
    public function notifications()
    {
        return $this->morphMany(Notification::class, 'notifiable');
    }
    public function getCreateDateAttribute($value)
    {
        return Carbon::parse(@$this->created_at)->format('Y-m-d');
    }

    public function getImageAttribute($value)
    {
        return !is_null($value) ? asset(Storage::url($value)) : ''/*asset('assets/images/placeholder.png')*/;
    }
    public function getIdImageAttribute($value)
    {
        return !is_null($value) ? asset(Storage::url($value)) : ''/*asset('assets/images/placeholder.png')*/;
    }

    public function getIsAvailableTextAttribute($value)
    {
        return @[0 => __('common.no'), 1 => __('common.yes')][$this->is_available];
    }


    public function tripType(){
        return $this->belongsTo(TripType::class);
    }
    public function vehicleType(){
        return $this->belongsTo(VehicleType::class);
    }
    public function services(){
        return $this->belongsToMany(Service::class, 'driver_services');
    }


    public function getVehicleTypeNameAttribute ()
    {
        return @$this->vehicleType->name;
    }
    public function getTripTypeNameAttribute ()
    {
        return @$this->tripType->name;
    }
    public function getVehicleImageAttribute($value)
    {
        return !is_null($value) ? asset(Storage::url($value)) : '';
    }
    public function getDriverLicenceImageAttribute($value)
    {
        return !is_null($value) ? asset(Storage::url($value)) : '';
    }
    public function getVehicleLicenceImageAttribute($value)
    {
        return !is_null($value) ? asset(Storage::url($value)) : '';
    }
    public function getIsVerifiedAttribute($value)
    {
        return !is_null($this->email_verified_at) ? 1 : 0;
    }


}
