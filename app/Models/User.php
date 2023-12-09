<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "phone",
        "phone_verified_at",
        "name",
        "family",
        "birth",
        "balance",
        "email",
        "email_verified_at",
        "password",
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

    protected $relations = [
        "roles",
        "otps",
        "movies",
        "tickets",
    ];
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    public function otps(): HasMany
    {
        return $this->hasMany(Otp::class);
    }

    public function movies(): BelongsToMany
    {
        return $this->belongsToMany(Movie::class);
    }

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }

    public function isAdmin(): bool
    {
        foreach ($this->roles as $role) {
            if ($role->name == "admin")
            {
                return true;
            }
        }
        return false;
    }

    public function isDirector(): bool
    {
        foreach ($this->roles as $role) {
            if ($role->name == "director")
            {
                return true;
            }
        }
        return false;
    }

    public function isArtist(): bool
    {
        foreach ($this->roles as $role) {
            if ($role->name == "artist")
            {
                return true;
            }
        }
        return false;
    }

    public function scopeRole(Builder $query, string $role)
    {
        return $query->with("roles")
            ->whereHas("roles", function (Builder $query) use ($role){
            $query->where("name", $role);
        });
    }

}
