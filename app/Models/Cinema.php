<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;

/**
 * @method static orderByCities()
 */
class Cinema extends Model
{
    use HasFactory;

    protected $fillable = [
        "city_id",
        "name",
        "address",
        "rating",
        "salons",
    ];

    protected $relations = [
        "city",
        "movies",
        "tickets",
    ];


    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function salons(): HasMany
    {
        return $this->hasMany(Salon::class);
    }

    public function sessions(): HasManyThrough
    {
        return $this->hasManyThrough(Session::class, Salon::class);
    }

}
