<?php

namespace App\Contracts\Auth\Repository;

interface IAuthRepository
{
    public function createUser(array $data);
    public function findByEmail(string $email);
}
