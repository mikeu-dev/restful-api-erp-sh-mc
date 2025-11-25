<?php

namespace App\Modules\User\Repository;

use App\Base\BaseRepository;
use App\Modules\User\Model\User;

class UserRepository extends BaseRepository
{
    protected $model;
    public function __construct(User $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    public function model(): string
    {
        return User::class;
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function find(int $id, array $columns = ['*'])
    {
        return parent::find($id, $columns);
    }

    public function update(string $id, array $data)
    {
        $record = $this->find($id);
        return $record->update($data);
    }
}
