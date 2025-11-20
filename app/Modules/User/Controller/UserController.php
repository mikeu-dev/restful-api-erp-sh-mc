<?php

namespace App\Modules\User\Controller;

use App\Base\BaseController;
use App\Modules\User\Service\UserService;
use App\Services\ApiResponse;

class UserController extends BaseController
{
    public function __construct(UserService $service, ApiResponse $apiResponse)
    {
        parent::__construct($service, $apiResponse);
    }
}
