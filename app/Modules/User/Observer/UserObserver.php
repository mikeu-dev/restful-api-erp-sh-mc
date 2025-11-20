<?php

namespace App\Modules\User\Observer;

use App\Base\BaseObserver;

class UserObserver extends BaseObserver
{
    protected string $logName = 'user';

    public function __construct()
    {
        $this->setLogName();
    }

    protected function setLogName(): void
    {
        $this->logName = 'user';
    }

    public function updated($user)
    {
        parent::updated($user); 

        if ($user->isDirty('role_id')) {
            $this->logActivity($user, 'role changed', [
                'old_role' => $user->getOriginal('role_id'),
                'new_role' => $user->role_id,
            ]);
        }
    }
}
