<?php

namespace App\Contracts\Servies\User;

interface IUserService
{
    public function createUser($request);
    public function updateUser(int $id, $request);
    public function changePassword($request);
}
