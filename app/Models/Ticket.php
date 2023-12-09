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
        "session",
        "salon",
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function session(): BelongsTo
    {
        return $this->belongsTo(Session::class);
    }


}
