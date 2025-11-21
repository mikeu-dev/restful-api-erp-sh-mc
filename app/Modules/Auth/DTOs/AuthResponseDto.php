<?php

namespace App\Modules\Auth\DTOs;

use App\Modules\User\Model\User;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthResponseDto
{
    public string $accessToken;
    public string $tokenType;
    public ?string $refreshToken;
    public User $user;

    public function __construct(string $accessToken, User $user, string $tokenType = 'Bearer', ?string $refreshToken = null)
    {
        $this->accessToken = $accessToken;
        $this->refreshToken = $refreshToken;
        $this->user = $user;
        $this->tokenType = $tokenType;
    }

    public function toArray(): array
    {
        return [
            'access_token' => $this->accessToken,
            'refresh_token'=> $this->refreshToken,
            'token_type' => $this->tokenType,
            'expires_in' => JWTAuth::factory()->getTTL() * 60,
            'user' => $this->user
        ];
    }
}
