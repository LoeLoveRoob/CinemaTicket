<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\MorphPivot;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Comment extends MorphPivot
{
    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }
}
