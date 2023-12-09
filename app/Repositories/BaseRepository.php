<?php

namespace App\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Spatie\QueryBuilder\QueryBuilder;

class BaseRepository implements BaseRepositoryInterface
{
    public function __construct(public Model $model)
    {
    }

    public function query(array $payload): Builder | QueryBuilder
    {
        return $this->model->query($payload);
    }

    public function find(
        mixed  $value,
        string $field = "id",
        array  $selected = ["*"],
        array  $with = [],
        bool   $findOrFail = false
    ): Model|Builder|null
    {
        $foundedModel = $this->model->with($with)->select($selected)->where($field, $value);
        if ($findOrFail) {
            return $foundedModel->firstOrFail();
        }
        return $foundedModel->first();
    }

    public function paginate($limit = null, array $payload = []): LengthAwarePaginator | Collection
    {
        if (is_null($limit)){
            $limit = 10;
        }
        if ($limit == -1)
        {
            return $this->query($payload)->get();
        }
        return $this->query($payload)->paginate($limit);
    }

    public function store(array $payload): Model
    {
        return $this->model->create($payload);
    }

    public function update(Model $model, array $payload): Model
    {
        $model->update($payload);
        return $model;
    }

    public function delete(Model $model): ?bool
    {
        return $model->delete();
    }
}
