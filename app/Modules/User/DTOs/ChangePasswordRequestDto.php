<?php

namespace App\Modules\User\DTOs;

class ChangePasswordRequestDto
{
    public string $password;
    /**
     * Create a new class instance.
     */
    public function __construct(array $data)
    {
        $this->password = $data['password'];
    }

    public function toArray(): array
    {
        return [
            'password' => $this->password,
        ];
    }
}
