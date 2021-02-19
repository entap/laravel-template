<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Entap\Auth\Traits\HasAuthProviders;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use HasApiTokens;
    use HasAuthProviders;
    use Suspendable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    protected $dates = ['suspending_expires_at', 'suspended_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function devices()
    {
        return $this->hasMany(UserDevice::class);
    }

    public function notificationDevices()
    {
        return $this->hasMany(UserNotificationDevice::class);
    }

    public function getDeviceTokens()
    {
        return $this->notificationDevices->pluck('token');
    }
}
