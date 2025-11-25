<?php

namespace App\Base;

use App\Contracts\Base\Repository\BaseRepositoryContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Closure;

abstract class BaseRepository implements BaseRepositoryContract
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Membuat query builder baru
     */
    public function query(): Builder
    {
        return $this->model->newQuery();
    }

    /**
     * Paginate dengan filter, sort, relation, dan callback
     */
    public function paginate(
        int $perPage = 15,
        array $columns = ['*'],
        array $filters = [],
        array $sorts = [],
        array $relations = [],
        ?Closure $callback = null
    ) {
        $query = $this->query();

        // Eager Load ramah relasi
        if (!empty($relations)) {
            foreach ($relations as $key => $relation) {
                if ($relation instanceof Closure && is_string($key)) {
                    // relasi dengan closure: ['posts' => fn($q) => $q->where(...)]
                    $query->with([$key => $relation]);
                } elseif (is_int($key) && is_string($relation)) {
                    // relasi sederhana: ['roles']
                    $query->with($relation);
                }
            }
        }

        // Filtering dinamis
        foreach ($filters as $field => $value) {
            if ($value instanceof Closure) {
                // filter custom menggunakan closure
                $value($query);
            } elseif (is_array($value)) {
                // format: ['field', 'operator', 'value']
                $query->where(...$value);
            } else {
                $query->where($field, $value);
            }
        }

        // Sorting dinamis
        foreach ($sorts as $column => $direction) {
            if ($column instanceof Closure) {
                $column($query);
            } else {
                $query->orderBy($column, $direction);
            }
        }

        // Callback untuk custom query
        if ($callback instanceof Closure) {
            $callback($query);
        }

        return $query->paginate($perPage, $columns);
    }

    /**
     * Ambil semua data dengan relasi optional
     */
    public function all(array $columns = ['*'], array $relations = [])
    {
        $query = $this->query();

        if (!empty($relations)) {
            foreach ($relations as $key => $relation) {
                if ($relation instanceof Closure && is_string($key)) {
                    $query->with([$key => $relation]);
                } elseif (is_int($key) && is_string($relation)) {
                    $query->with($relation);
                }
            }
        }

        return $query->get($columns);
    }

    public function find(int $id, array $columns = ['*'], array $relations = [])
    {
        $query = $this->query();

        if (!empty($relations)) {
            foreach ($relations as $key => $relation) {
                if ($relation instanceof Closure && is_string($key)) {
                    $query->with([$key => $relation]);
                } elseif (is_int($key) && is_string($relation)) {
                    $query->with($relation);
                }
            }
        }

        return $query->find($id, $columns);
    }

    public function delete(int $id)
    {
        $record = $this->find($id);
        return $record ? $record->delete() : false;
    }

    abstract public function model(): string;
}
