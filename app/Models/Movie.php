<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
        "genres",
        "cinemas",
        "artists",
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
        return $this->belongsToMany(Cinema::class)->withPivotValue("salons");
    }

    public function artists(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            "artist_movie",
            "artist_id",
        )->withPivotValue("salary");
    }
}
