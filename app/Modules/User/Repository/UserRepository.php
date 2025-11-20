<?php

namespace App\Modules\User\Repository;

use App\Base\BaseRepository;
use App\Modules\User\Model\User;

class UserRepository extends BaseRepository
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function model(): string
    {
        return User::class;
    }
}
