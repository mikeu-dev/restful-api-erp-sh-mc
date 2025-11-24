<?php

namespace App\Modules\User\DTOs;

class UserRequestDto
{
    public $name;
    public $email;
    public $username;
    public $password;
    public $password_confirmation;
    /**
     * Create a new class instance.
     */
    public function __construct(array $data)
    {
        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->username = $data['username'];
        $this->password = $data['password'];
        $this->password_confirmation = $data['password_confirmation'];
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
            'password_confirmation' => $this->password_confirmation,
        ];
    }
}
