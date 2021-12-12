<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Vehicle extends Model
{
    use SoftDeletes;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $guarded = [];
    protected $appends = ['trip_type_name', 'service_name', 'vehicle_type_name'];
    protected $translatable = ['name'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at', 'service_id', 'driver_id', 'trip_type_id',
        'vehicle_type_id', 'service_id', 'tripType', 'vehicleType', 'service'];


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
    public function getTripTypeNameAttribute ()
    {
        return @$this->tripType->name;
    }
    public function getServiceNameAttribute ()
    {
        return @$this->service->name;
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
