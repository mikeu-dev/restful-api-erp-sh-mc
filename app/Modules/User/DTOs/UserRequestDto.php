<?php

namespace App\Modules\User\DTOs;

class UserRequestDto
{
    public string $name;
    public string $email;
    public string $username;
    public string $password;
    /**
     * Create a new class instance.
     */
    public function __construct(array $data)
    {
        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->username = $data['username'];
        $this->password = $data['password'];
    }

    /**
     * Convert DTO to array
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'username' => $this->username,
            'password' => $this->password,
        ];
    }
}
