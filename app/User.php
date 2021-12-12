<?php

namespace App;

use App\Models\Notification;
use App\Notifications\UserResetPasswordNotification;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, Notifiable, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
    protected $appends = ['is_verified', 'create_date'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'apple_id', 'google_id', 'email_verified_at',
        'created_at', 'updated_at', 'deleted_at', 'status'
    ];

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

    public function getStatusTextAttribute($value)
    {
        $arr = [1 => __('common.active'), 0 => __('common.inactive')];
        return @$arr[$this->status];
    }

    public function getImageAttribute($value)
    {
//        dd(asset(Storage::url($value)));
        return !is_null($value) ? asset(Storage::url($value)) : '';//asset('assets/images/placeholder.png');
    }
    public function getCreateDateAttribute($value)
    {
        return @Carbon::parse(@$this->created_at)->format('Y-m-d');
    }

    public function getIsVerifiedAttribute($value)
    {
        return !is_null($this->email_verified_at) ? 1 : 0;
    }

}
