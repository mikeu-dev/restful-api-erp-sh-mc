<?php

namespace App\Modules\User\DTOs;

use App\Modules\User\Model\User;

class UserResponseDto
{
    public $name;
    public $email;
    public $username;
    /**
     * Create a new class instance.
     */
    public function __construct(array $data)
    {
        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->username = $data['username'];
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
        ];
    }
}
