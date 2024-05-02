<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class CertifiedProvider extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'certified_providers';
    protected $primaryKey = 'provider_id';
    const ROLE_ADMIN = 'admin';
    const ROLE_PROVIDER = 'provider';
    protected $fillable = [
        'provider_type',
        'provider_administrator',
        'provider_name',
        'provider_logo_image',
        'provider_profile_image',
        'provider_email',
        'provider_phone',
        'provider_password',
        'provider_status',
        'provider_otp',
    ];

    protected $hidden = [
        'provider_password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'provider_password' => 'hashed',
        ];
    }
    
    public function getAuthPassword()
    {
        return $this->provider_password;
    }
    public function isAdmin()
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isProvider()
    {
        return $this->role === self::ROLE_PROVIDER;
    }

    public function CertifiedApplicators()
    {
        return $this->hasMany(CertifiedApplicator::class, 'applicator_provider_id', 'provider_id');
    }

    public function clients()
    {
        return $this->hasMany(Client::class, 'client_provider_id', 'provider_id');
    }
}
