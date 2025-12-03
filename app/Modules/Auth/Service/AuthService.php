<?php

namespace App\Modules\Auth\Service;

use App\Contracts\Auth\Service\IAuthService;
use App\Modules\Auth\DTOs\AuthResponseDto;
use App\Modules\Auth\DTOs\LoginRequestDto;
use App\Modules\Auth\DTOs\RegisterRequestDto;
use App\Modules\Auth\Repository\AuthRepository;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthService implements IAuthService
{
    protected $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function login(LoginRequestDto $request): AuthResponseDto
    {
        if (!Auth::attempt($request->toArray())) {
            throw new \Exception('Login failed, invalid credentials');
        }

        try {
            $token = JWTAuth::attempt($request->toArray());

            if (!$token) {
                throw new \Exception('Login failed, invalid credentials');
            }

            $refreshToken = JWTAuth::claims(['type' => 'refresh'])->fromUser(Auth::user());

            return new AuthResponseDto(
                $token,
                Auth::user(),
                'Bearer',
                $refreshToken
            );
        } catch (JWTException $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function register(RegisterRequestDto $request): AuthResponseDto
    {
        if ($request->password !== $request->password_confirmation) {
            throw new \Exception('Confirm password not match');
        }

        $user = $this->authRepository->createUser($request->toArray());

        if (!$user) {
            throw new \Exception('Register failed');
        }

        try {
            $accessToken = JWTAuth::fromUser($user);
            $refreshToken = JWTAuth::claims(['type' => 'refresh'])->fromUser($user);

            return new AuthResponseDto(
                $accessToken,
                $user,
                'Bearer',
                $refreshToken
            );
        } catch (JWTException $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function logout(): bool
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            return true;
        } catch (JWTException $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function refresh($request): AuthResponseDto
    {
        try {
            $oldRefreshToken = $request->bearerToken();

            if (!$oldRefreshToken) {
                throw new \Exception('Refresh token required');
            }

            $user = JWTAuth::setToken($oldRefreshToken)->toUser();

            $newAccessToken = JWTAuth::fromUser($user);
            $newRefreshToken = JWTAuth::claims(['type' => 'refresh'])->fromUser($user);

            return new AuthResponseDto(
                $newAccessToken,
                $user,
                'Bearer',
                $newRefreshToken
            );
        } catch (JWTException $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function me()
    {
        try {
            return JWTAuth::parseToken()->authenticate();
        } catch (JWTException $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
