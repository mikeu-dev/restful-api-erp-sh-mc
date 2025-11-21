<?php

namespace App\Modules\Auth\DTOs;

class LoginRequestDto
{
    public $email;
    public $password;
    /**
     * Create a new class instance.
     */
    public function __construct(array $data)
    {
        $this->email = $data['email'];
        $this->password = $data['password'];
    }

    /**
     * Convert DTO to array
     */
    public function toArray(): array
    {
        return [
            'email' => $this->email,
            'password' => $this->password
        ];
    }
}
