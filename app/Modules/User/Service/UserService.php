<?php

namespace App\Modules\User\Service;

use App\Base\BaseService;
use App\Modules\User\Repository\UserRepository;

class UserService extends BaseService
{
    public function __construct(UserRepository $repository)
    {
        parent::__construct($repository);
    }
}
