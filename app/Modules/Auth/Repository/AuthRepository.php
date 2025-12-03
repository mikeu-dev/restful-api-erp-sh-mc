<?php

namespace App\Modules\Auth\Repository;

use App\Contracts\Auth\Repository\IAuthRepository;
use App\Modules\User\Model\User;

class AuthRepository implements IAuthRepository
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function createUser(array $data)
    {
        return $this->model->create($data);
    }

    public function findByEmail(string $email)
    {
        return $this->model->where('email', $email)->first();
    }
}
