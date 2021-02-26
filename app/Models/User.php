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

    public function agreements()
    {
        return $this->belongsToMany(Agreement::class, 'user_agreement');
    }

    public function getDeviceTokens()
    {
        return $this->notificationDevices->pluck('token');
    }

    public function hasAgreed($agreementType)
    {
        $agreement = $this->agreements()
            ->where('agreement_type_id', $agreementType->id)
            ->latest()
            ->first();
        if (empty($agreement)) {
            return false;
        }
        if ($agreementType->isStrictMode()) {
            // 新しい契約が作られてなければ真
            return $agreementType
                ->where('created_at', '>', $agreement->created_at)
                ->count() === 0;
        }
        return true;
    }
}
