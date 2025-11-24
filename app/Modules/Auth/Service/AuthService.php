<?php

namespace App\Modules\Auth\Service;

use App\Contracts\Services\Auth\IAuthService;
use App\Modules\Auth\DTOs\AuthResponseDto;
use App\Modules\Auth\DTOs\LoginRequestDto;
use App\Modules\Auth\DTOs\RegisterRequestDto;
use App\Modules\Auth\Repository\AuthRepository;
use App\Services\ApiResponse;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthService implements IAuthService
{
    protected $authRepository;
    protected $apiResponse;

    public function __construct(AuthRepository $authRepository, ApiResponse $apiResponse)
    {
        $this->authRepository = $authRepository;
        $this->apiResponse = $apiResponse;
    }

    public function login(LoginRequestDto $request)
    {
        if (!Auth::attempt($request->toArray())) {
            return $this->apiResponse->validationFailed('Login failed, invalid credentials');
        }

        try {
            $token = JWTAuth::attempt($request->toArray());

            if (!$token) {
                return $this->apiResponse->validationFailed('Login failed, invalid credentials');
            }

            $refreshToken = JWTAuth::claims(['type' => 'refresh'])->fromUser(Auth::user());
            $user = Auth::user();
            $data = new AuthResponseDto(
                $token,
                $user,
                'Bearer',
                $refreshToken
            );


            return $this->apiResponse->success($data, 'Login successful');
        } catch (JWTException $e) {
            return $this->apiResponse->serverError($e->getMessage());
        }
    }


    public function register(RegisterRequestDto $request)
    {
        if ($request->password !== $request->password_confirmation) {
            return $this->apiResponse->validationFailed('Confirm password not match');
        }

        $user = $this->authRepository->createUser($request->toArray());

        if (!$user) {
            return $this->apiResponse->serverError('Register failed');
        }

        try {
            $accessToken = JWTAuth::fromUser($user);

            $refreshToken = JWTAuth::claims(['type' => 'refresh'])->fromUser($user);

            $data = new AuthResponseDto(
                $accessToken,
                $user,
                'Bearer',
                $refreshToken
            );

            return $this->apiResponse->success($data, 'Register success');
        } catch (JWTException $e) {
            return $this->apiResponse->serverError($e->getMessage());
        }
    }


    public function logout()
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            return $this->apiResponse->success(null, 'Logout success');
        } catch (JWTException $e) {
            return $this->apiResponse->serverError($e->getMessage());
        }
    }

    public function refresh($request)
    {
        try {
            $oldRefreshToken = $request->bearerToken();
            if (!$oldRefreshToken) {
                return $this->apiResponse->validationFailed('Refresh token required');
            }

            $user = JWTAuth::setToken($oldRefreshToken)->toUser();

            $newAccessToken = JWTAuth::fromUser($user);
            $newRefreshToken = JWTAuth::claims(['type' => 'refresh'])->fromUser($user);

            $data = new AuthResponseDto($newAccessToken, $user, 'Bearer', $newRefreshToken);

            return $this->apiResponse->success($data, 'Token refreshed successfully');
        } catch (JWTException $e) {
            return $this->apiResponse->serverError($e->getMessage());
        }
    }


    public function me()
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            return $this->apiResponse->success($user);
        } catch (JWTException $e) {
            return $this->apiResponse->serverError($e->getMessage());
        }
    }
}
