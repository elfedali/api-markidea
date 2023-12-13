<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const ROLE_SUPER_ADMIN = 'role_super_admin';
    const ROLE_ADMIN = 'role_admin';
    const ROLE_USER = 'role_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',

        'first_name',
        'last_name',
        'phone_number',

        'address',
        'city',
        'zip_code',
        'country',

        'photo',
        'is_enabled',

        'provider',
        'provider_id',

        'email_verified_at',
        'email_verification_token',

        'phone_number_verified_at',
        'phone_number_verification_token',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get the user's full name.
     * 
     */
    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }
    /**
     * Uppercase the last name when setting it.
     * 
     */
    public function setLastNameAttribute(string $value): void
    {
        $this->attributes['last_name'] = strtoupper($value);
    }

    /**
     * Get the user's full address.
     * 
     */
    public function getFullAddressAttribute(): string
    {
        return "{$this->address} {$this->city} {$this->zip_code} {$this->country}";
    }

    /**
     * Get the user's shops.
     * 
     */
    public function shops(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Shop::class);
    }

    /**
     * Get the user's reviews.
     * 
     */
    public function reviews(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Review::class);
    }
}
