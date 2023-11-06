<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cinema extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "address",
        "rating",
        "salons",
    ];

    protected $relations = [
        "movies",
        "tickets",
    ];

    public function movies(): BelongsToMany
    {
        return $this->belongsToMany(Movie::class)->withPivotValue("salons");
    }

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }
}
