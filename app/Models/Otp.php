<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Otp extends Model
{
    use HasFactory;

    const EXPIRATION_TIME = 15; //minutes

    protected $fillable = [
        "user_id",
        "code",
        "secret",
        "used",
    ];

    protected $relations = [
        "user"
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function isExpired(): bool
    {
        return $this->created_at->diffInMinutes(Carbon::now()) > static::EXPIRATION_TIME;
    }

    public function isValid(): bool
    {
        return ! $this->used && ! $this->isExpired();
    }

    public function scopeActive(Builder $query)
    {
        return $query->where("used", true)
            ->where("expire_at", ">", Carbon::now());
    }
}
