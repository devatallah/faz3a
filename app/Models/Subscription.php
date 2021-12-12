<?php

namespace App\Models;

use App\Driver;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Subscription extends Model
{

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $guarded = [];
    protected $appends = ['driver_name', 'plan_name', 'is_expired'];
    protected $hidden = ['driver', 'plan', 'created_at', 'updated_at', 'deleted_at'];

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

    public function driver(){
        return $this->belongsTo(Driver::class)->withTrashed();
    }
    public function plan(){
        return $this->belongsTo(Plan::class)->withTrashed();
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

    public function getDriverNameAttribute(){
        return @$this->driver->name;
    }
    public function getPlanNameAttribute(){
        return @$this->plan->name;
    }
    public function getIsExpiredAttribute(){
        return [0 => false, 1 => true][Carbon::parse(@$this->to)->isPast()];
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
