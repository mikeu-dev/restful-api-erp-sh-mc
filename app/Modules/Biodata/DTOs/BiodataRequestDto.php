<?php

namespace App\Modules\Biodata\DTOs;

use Illuminate\Validation\Rules\Date;

class BiodataRequestDto
{
    public $name;
    public $phone;
    public $pob;
    public $dob;
    public $gender;
    public $user_id;
    public $religion_id;

    public function __construct(array $data)
    {
        $this->name = $data['name'];
        $this->phone = $data['phone'];
        $this->pob = $data['pob'];
        $this->dob = $data['dob'];
        $this->gender = $data['gender'];
        $this->user_id = $data['user_id'];
        $this->religion_id = $data['religion_id'];
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'phone' => $this->phone,
            'pob' => $this->pob,
            'dob' => $this->dob,
            'gender' => $this->gender,
            'user_id' => $this->user_id,
            'religion_id' => $this->religion_id
        ];
    }
}
