<?php

namespace App\Modules\Auth\Controller;

use App\Http\Controllers\Controller;
use App\Modules\Auth\DTOs\LoginRequestDto;
use App\Modules\Auth\DTOs\RegisterRequestDto;
use App\Modules\Auth\Service\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(Request $request)
    {
        $dto = new LoginRequestDto($request->only('email', 'password'));
        return $this->authService->login($dto);
    }

    public function register(Request $request)
    {
        $dto = new RegisterRequestDto($request->only('name', 'email', 'username', 'password', 'password_confirmation'));
        return $this->authService->register($dto);
    }

    public function logout()
    {
        return $this->authService->logout();
    }

    public function refresh(Request $request)
    {
        return $this->authService->refresh($request);
    }

    public function me()
    {
        return $this->authService->me();
    }
}
