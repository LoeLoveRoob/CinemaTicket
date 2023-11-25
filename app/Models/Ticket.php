<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

/**
 * @method static orderByMovies()
 * @method static orderByCinemas()
 */
class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "cinema_id",
        "time",
        "salon",
    ];

    protected $relations = [
        "user",
        "cinema",
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function cinema(): BelongsTo
    {
        return $this->belongsTo(Cinema::class);
    }

    public function scopeOrderByMovies(Builder $query): Builder
    {
        return $query->select('movie_id', DB::raw('COUNT(*) as usage_count'))
            ->groupBy('movie_id')
            ->orderBy('usage_count');
    }

    public function scopeOrderByCinemas(Builder $query): Builder
    {
        return $query->select('cinema_id', DB::raw('COUNT(*) as ticket_count'))
            ->groupBy('cinema_id')
            ->orderBy('ticket_count');
    }



}
