<?php

namespace App\Modules\User\Service;

use App\Base\BaseService;
use App\Modules\User\Repository\UserRepository;

class UserService extends BaseService
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
}
