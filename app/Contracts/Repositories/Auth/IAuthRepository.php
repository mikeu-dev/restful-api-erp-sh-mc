<?php

namespace App\Contracts\Repositories\Auth;

interface IAuthRepository
{
    public function createUser(array $data);
    public function findByEmail(string $email);
}
