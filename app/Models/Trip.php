<?php

namespace App\Models;

use App\Driver;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trip extends Model
{
    use SoftDeletes;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $guarded = [];
    protected $appends = ['trip_type_name', 'service_name', 'vehicle_type_name', 'user_name', 'user_image', 'driver_name', 'driver_image'];
    protected $hidden = ['deleted_at', 'tripType', 'vehicleType', 'service', 'user', 'driver'];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function tripType(){
        return $this->belongsTo(TripType::class);
    }
    public function vehicleType(){
        return $this->belongsTo(VehicleType::class);
    }
    public function service(){
        return $this->belongsTo(Service::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function driver(){
        return $this->belongsTo(Driver::class);
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */

    public function getVehicleTypeNameAttribute ()
    {
        return @$this->vehicleType->name;
    }
    public function getUserNameAttribute ()
    {
        return @$this->user->name;
    }
    public function getUserImageAttribute ()
    {
        return @$this->user->image;
    }
    public function getDriverNameAttribute ()
    {
        return @$this->driver->name;
    }
    public function getDriverImageAttribute ()
    {
        return @$this->driver->image;
    }
    public function getTripTypeNameAttribute ()
    {
        return @$this->tripType->name;
    }
    public function getServiceNameAttribute ()
    {
        return @$this->service->name;
    }
    public function getCreateDateAttribute($value)
    {
        return @$this->created_at->format('Y-m-d');
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | BOOTS
    |--------------------------------------------------------------------------
    */

}
