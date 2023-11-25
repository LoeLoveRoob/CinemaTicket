<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
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


    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function movies(): BelongsToMany
    {
        return $this->belongsToMany(Movie::class)->withPivotValue("salons");
    }

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }

    public function scopeOrderByCities(Builder $query): Builder
    {
        return $query->select('city_id', DB::raw('COUNT(*) as ticket_count'))
            ->groupBy('city_id')
            ->orderBy('ticket_count');
    }
}
