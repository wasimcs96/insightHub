<?php
// app/Repositories/BaseRepository.php

namespace App\Repositories;

use App\Contracts\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements RepositoryInterface
{
    protected $model;
    protected $with = [];

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all(): Collection
    {
        $query = $this->model->newQuery();
        
        if (!empty($this->with)) {
            $query->with($this->with);
        }
        
        return $query->get();
    }

    public function find(int $id): ?Model
    {
        $query = $this->model->newQuery();
        
        if (!empty($this->with)) {
            $query->with($this->with);
        }
        
        return $query->find($id);
    }

    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data): bool
    {
        return $this->model->where('id', $id)->update($data);
    }

    public function delete(int $id): bool
    {
        return $this->model->destroy($id);
    }

    public function where(string $column, $value): Collection
    {
        $query = $this->model->newQuery();
        
        if (!empty($this->with)) {
            $query->with($this->with);
        }
        
        return $query->where($column, $value)->get();
    }

    public function with(array $relations): self
    {
        $this->with = $relations;
        return $this;
    }

    protected function resetWith(): void
    {
        $this->with = [];
    }
}