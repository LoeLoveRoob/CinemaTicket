<?php

namespace App\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Spatie\QueryBuilder\QueryBuilder;

interface BaseRepositoryInterface
{
    public function query(array $payload): Builder | QueryBuilder;

    public function find(
        mixed  $value,
        string $field = "id",
        array  $selected = ["*"],
        array  $with = [],
        bool   $findOrFail = false
    ): Model|Builder|null;

    public function store(array $payload): Model;

    public function update(Model $model, array $payload): Model;

    public function delete(Model $model): ?bool;

    public function paginate(null | int $limit = null, array $payload = []): LengthAwarePaginator | Collection;
}

