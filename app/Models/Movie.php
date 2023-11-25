<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Facades\DB;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        "category_id",
        "director_id",
        "name",
        "rating",
        "about",
        "short_story",
    ];

    protected $relations = [
        "category",
        "director",
        "tickets",
        "genres",
        "cinemas",
        "artists",
        "cities"
    ];


    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function director(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class);
    }

    public function cinemas(): BelongsToMany
    {
        return $this->belongsToMany(Cinema::class);
    }

    public function artists(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function tickets(): HasManyThrough
    {
        return $this->hasManyThrough(Ticket::class, Session::class);
    }
}
