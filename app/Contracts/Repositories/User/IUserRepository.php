<?php

namespace App\Contracts\Repositories\User;

interface IUserRepository
{
    public function create(array $data);
    public function update(int $id, array $data);
    public function changePassword(array $data);
}
