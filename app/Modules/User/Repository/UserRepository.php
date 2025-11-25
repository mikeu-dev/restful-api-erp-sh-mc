<?php

namespace App\Modules\User\Repository;

use App\Base\BaseRepository;
use App\Contracts\Repositories\User\IUserRepository;
use App\Modules\User\Model\User;

class UserRepository extends BaseRepository implements IUserRepository
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

    public function update(int $id, array $data)
    {
        $record = $this->find($id);
        return $record->update($data);
    }

    public function changePassword(array $data)
    {
        return $this->model->update($data);
    }
}
