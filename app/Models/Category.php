<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use SoftDeletes, HasTranslations;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $guarded = [];
    protected $appends = ['status_text'];
    protected $hidden = ['translations', 'created_at', 'updated_at', 'deleted_at', 'status', 'category'];
    protected $translatedAttributes = ['name'];

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
    public function products ()
    {
        return $this->hasMany(Product::class);
    }
    public function sizes ()
    {
        return $this->hasMany(Size::class);
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

    public function getImageAttribute ($value)
    {
        return !is_null($value) ? asset(Storage::url($value)) : '';
    }

    public function getStatusTextAttribute ($value)
    {
        $arr = [1 => __('common.active'), 0 => __('common.inactive')];
        return $arr[$this->status];
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
