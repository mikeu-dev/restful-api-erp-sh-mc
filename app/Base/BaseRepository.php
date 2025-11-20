<?php

namespace App\Base;

use App\Contracts\Repositories\BaseRepositoryContract;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements BaseRepositoryContract
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all(array $columns = ['*'])
    {
        return $this->model->all($columns);
    }

    public function find(int $id, array $columns = ['*'])
    {
        return $this->model->find($id, $columns);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data)
    {
        $record = $this->find($id);
        if ($record) {
            $record->update($data);
            return $record;
        }
        return null;
    }

    public function delete(int $id)
    {
        $record = $this->find($id);
        return $record ? $record->delete() : false;
    }

    abstract public function model(): string;
}
