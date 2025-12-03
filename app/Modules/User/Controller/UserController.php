<?php

namespace App\Modules\User\Controller;

use App\Base\BaseController;
use App\Modules\User\DTOs\ChangePasswordRequestDto;
use App\Modules\User\DTOs\UserRequestDto;
use App\Modules\User\Requests\ChangePasswordRequest;
use App\Modules\User\Requests\UserRequest;
use App\Modules\User\Service\UserService;
use App\Services\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends BaseController
{
    protected $userService;
    public function __construct(UserService $service, ApiResponse $apiResponse)
    {
        parent::__construct($service, $apiResponse);
        $this->userService = $service;
    }

    public function index()
    {
        return parent::index();
    }

    public function store(UserRequest $request)
    {
        $data = $request->validated();

        if (!isset($data['password']) || empty($data['password'])) {
            $data['password'] = env('PASSWORD_DEFAULT');
        }

        $dto = new UserRequestDto($data);

        try {
            $result = $this->userService->createUser($dto->toArray());
            return $this->apiResponse->created($result);
        } catch (\Exception $e) {
            Log::error('Gagal membuat user: ' . $e->getMessage(), [
                'stack' => $e->getTraceAsString()
            ]);
            return $this->apiResponse->serverError();
        }
    }

    public function show(int $id)
    {
        return parent::show($id);
    }

    public function update(UserRequest $request, int $id)
    {
        $dto = new UserRequestDto($request->validated());

        try {
            $result =  $this->userService->updateUser($id, $dto->toArray());
            return $this->apiResponse->success($result);
        } catch (\Exception $e) {
            Log::error('Gagal membuat user: ' . $e->getMessage(), [
                'stack' => $e->getTraceAsString()
            ]);
            return $this->apiResponse->serverError();
        }
    }

    public function destroy(int $id)
    {
        return parent::destroy($id);
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $dto = new ChangePasswordRequestDto($request->validated());

        try {
            $result =  $this->userService->changePassword($dto->toArray());
            return $this->apiResponse->success($result);
        } catch (\Exception $e) {
            Log::error('Failed to change password : ' . $e->getMessage(), [
                'stack' => $e->getTraceAsString()
            ]);
            return $this->apiResponse->serverError();
        }
    }
}
