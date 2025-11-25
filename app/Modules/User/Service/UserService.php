<?php

namespace App\Modules\User\Service;

use App\Base\BaseService;
use App\Contracts\User\Service\IUserService;
use App\Modules\User\Repository\UserRepository;

class UserService extends BaseService implements IUserService
{
    protected $userRepository;
    public function __construct(UserRepository $repository)
    {
        parent::__construct($repository);
        $this->userRepository = $repository;
    }

    public function createUser($request)
    {
        return $this->userRepository->create($request);
    }

    public function updateUser($id, $request)
    {
        return $this->userRepository->update($id, $request);
    }

    public function changePassword($request)
    {
        return $this->userRepository->changePassword($request);
    }
}
