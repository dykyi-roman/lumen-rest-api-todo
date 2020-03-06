<?php

namespace App\todo\Domain\User\Event;

use App\Events\Event;
use App\todo\Domain\User\Model\Users;

/**
 * @see UserRegisteredListener
 */
final class UserRegisteredEvent extends Event
{
    private Users $users;

    public function __construct(Users $users)
    {
        $this->users = $users;
    }

    public function getUser(): Users
    {
        return $this->users;
    }
}
