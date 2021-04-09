<?php

namespace App\Models;

use App\Models\HasAuthProviders;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use HasApiTokens;
    use HasAuthProviders;
    use Suspendable;
    use HasRoles;

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

    /**
     * 規約に同意しているかどうか
     */
    public function hasAgreed($agreementType)
    {
        // TODO DBアクセスしない形の方がいいかも
        $agreement = $this->agreements()
            ->where('agreement_type_id', $agreementType->id)
            ->latest()
            ->first();
        if (empty($agreement)) {
            return false;
        }
        if ($agreementType->isStrictMode()) {
            return !$agreementType->hasNewAgreements($agreement->created_at);
        }
        return true;
    }

    /**
     * 検証ユーザーかどうか
     */
    public function isTester(string $guard = null)
    {
        return $this->hasRole('tester', $guard);
    }

    /**
     * メールアドレスから検索する
     */
    public static function findByEmail(string $email)
    {
        return self::where('email', $email)->first();
    }
}
