<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\KycSubmission;
use App\Models\Transaction;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'locale',
        'country_code',
        'timezone',
        'role',
        'wallet_address',
        'kyc_verified_at',
        'balance',
        'phone_verified_at'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_verified_at' => 'datetime',
        'kyc_verified_at' => 'datetime',
        'roles' => 'array',
        'balance' => 'decimal:2'
    ];

    public function kyc()
    {
        return $this->hasOne(KycSubmission::class)->latest();
    }

    public function getKycStatusAttribute()
    {
        return $this->kyc_verified_at ? 'verified' : 'unverified';
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function isAdmin()
    {
        return in_array('admin', $this->roles ?? []);
    }
}
