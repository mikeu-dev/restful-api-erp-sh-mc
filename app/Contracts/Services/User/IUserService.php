<?php

namespace App\Contracts\Servies\User;

interface IUserService
{
    public function create(array $data);
    public function update(int $id, array $data);
}
