<?php

namespace App\Base;

use App\Contracts\Repositories\BaseRepositoryContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

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
     * Paginasi fleksibel dengan filter, sort, relation, dan closure
     */
    public function paginate(
        int $perPage = 15,
        array $columns = ['*'],
        array $filters = [],
        array $sorts = [],
        array $relations = [],
        ?\Closure $callback = null
    ) {
        $query = $this->query();

        // Eager Load
        if (!empty($relations)) {
            $query->with($relations);
        }

        // Filtering dinamis
        foreach ($filters as $field => $value) {
            if (is_array($value)) {
                // format: ['field', 'operator', 'value']
                $query->where(...$value);
            } else {
                $query->where($field, $value);
            }
        }

        // Sorting dinamis
        foreach ($sorts as $column => $direction) {
            $query->orderBy($column, $direction);
        }

        // Callback untuk custom query
        if ($callback instanceof \Closure) {
            $callback($query);
        }

        return $query->paginate($perPage, $columns);
    }

    public function all(array $columns = ['*'])
    {
        return $this->model->all($columns);
    }

    public function find(int $id, array $columns = ['*'])
    {
        return $this->model->find($id, $columns);
    }

    public function delete(int $id)
    {
        $record = $this->find($id);
        return $record ? $record->delete() : false;
    }

    abstract public function model(): string;
}

