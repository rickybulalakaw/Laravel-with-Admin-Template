<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        // 'name',
        // 'email',
        // 'password',
        'name',
        'middle_name',
        'last_name',
        'extension',
        'dob',
        'email',
        'password',
        'position_id',
        'office_id',
        'supervisor_id',
        'function',
        'is_active'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public const STATUS_ACTIVE = 1;
    public const STATUS_INACTIVE = 0;

    public const IS_COLLECTOR = 1;
    public const IS_CONSOLIDATOR = 2;
    public const IS_CUSTODIAN = 3;
    public const IS_TREASURER = 4;
    public const IS_ADMIN = 5;
    
    public function accountable_forms () {
        return $this->hasMany(AccountableForm::class);
    }


    public function accountable_form_items () 
    {
        return $this->hasManyThrough(AccountableFormItem::class, AccountableForm::class);
    }

    public function comments () 
    {
        return $this->hasMany(Comment::class);
    }

    public function position () 
    {
        return $this->hasOne(Position::class);
    }

    public function office () 
    {
        return $this->hasOne(Office::class);
    }
}
