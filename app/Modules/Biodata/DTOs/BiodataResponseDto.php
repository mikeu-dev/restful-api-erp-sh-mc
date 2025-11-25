<?php

namespace App\Modules\Biodata\DTOs;

use App\Modules\Religion\Model\Religion;
use App\Modules\User\DTOs\UserResponseDto;

class BiodataResponseDto
{
    public $name;
    public $phone;
    public $pob;
    public $dob;
    public $gender;
    public UserResponseDto $user;
    public $religion;

    public function __construct(array $data)
    {
        $this->name = $data['name'];
        $this->phone = $data['phone'];
        $this->pob = $data['pob'];
        $this->dob = $data['dob'];
        $this->gender = $data['gender'];
        $this->user = $data['user']->toArray();
        $this->religion = $data['religion'];
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'phone' => $this->phone,
            'pob' => $this->pob,
            'dob' => $this->dob,
            'gender' => $this->gender,
            'user' => $this->user,
            'religion' => $this->religion
        ];
    }
}
