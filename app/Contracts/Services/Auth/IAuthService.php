<?php

namespace App\Contracts\Services\Auth;

use App\Modules\Auth\DTOs\LoginRequestDto;
use App\Modules\Auth\DTOs\RegisterRequestDto;
use Illuminate\Http\Request;

interface IAuthService
{
    public function login(LoginRequestDto $request);
    public function register(RegisterRequestDto $request);
    public function logout();
    public function me();
    public function refresh($request);
}
