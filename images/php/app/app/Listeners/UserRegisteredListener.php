<?php

namespace App\Listeners;

use App\Events\UserRegisteredEvent;
use App\todo\Domain\NotificationInterface;

class UserRegisteredListener
{
    private NotificationInterface $notification;

    public function __construct(NotificationInterface $notification)
    {
        $this->notification = $notification;
    }

    public function handle(UserRegisteredEvent $event): void
    {
        $this->notification->notify();
    }
}
