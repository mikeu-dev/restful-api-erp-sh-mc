<?php

namespace App\Contracts\User\Service;

interface IUserService
{
    public function createUser($request);
    public function updateUser(int $id, $request);
    public function changePassword($request);
}
