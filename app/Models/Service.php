<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Spatie\Translatable\HasTranslations;

class Service extends Model
{
    use SoftDeletes, HasTranslations;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $guarded = [];
    protected $appends = ['service_name', 'create_date'/*, 'for_passengers_text', 'for_packages_text'*/];
    protected $hidden = ['name', 'created_at', 'updated_at', 'deleted_at', 'pivot', 'for_passengers', 'for_packages'];
    protected $translatable = ['name'];

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

    public function vehicleTypes (){
        return $this->belongsToMany(VehicleType::class, 'service_vehicle_types');
    }
    public function tripTypes(){
        return $this->belongsToMany(TripType::class, 'service_trip_types');
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

    public function getServiceNameAttribute($value)
    {
        return @$this->name;
    }
    public function getCreateDateAttribute($value)
    {
        return @$this->created_at->format('Y-m-d');
    }
    public function getForPackagesTextAttribute($value)
    {
        return [0 => __('common.no'), 1 => __('common.yes')][$this->for_packages];
    }
    public function getForPassengersTextAttribute($value)
    {
        return [0 => __('common.no'), 1 => __('common.yes')][$this->for_passengers];
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
