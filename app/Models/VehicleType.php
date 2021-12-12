<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Spatie\Translatable\HasTranslations;

class VehicleType extends Model
{
    use SoftDeletes, HasTranslations;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $guarded = [];
    protected $appends = ['vehicle_type_name', 'create_date', 'services_text', 'packages_text'];
    protected $hidden = ['name', 'created_at', 'updated_at', 'deleted_at', 'services', 'pivot'];
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
    public function services(){
        return $this->belongsToMany(Service::class, 'service_vehicle_types');
    }
    public function packages(){
        return $this->belongsToMany(Package::class, 'package_vehicle_types');
    }
    public function tripTypes(){
        return $this->belongsToMany(TripType::class, 'trip_type_vehicle_types');
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

    public function getVehicleTypeNameAttribute($value)
    {
        return @$this->name;
    }
    public function getCreateDateAttribute($value)
    {
        return @$this->created_at->format('Y-m-d');
    }
    public function getServicesTextAttribute($value)
    {
        $services = $this->services()->pluck('name')->toArray();
        return implode(',', $services);
    }
    public function getPackagesTextAttribute($value)
    {
        $packages = $this->packages()->pluck('name')->toArray();
        return implode(',', $packages);
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
