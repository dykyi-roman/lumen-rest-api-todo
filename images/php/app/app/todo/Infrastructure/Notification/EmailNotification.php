<?php

declare(strict_types=1);

namespace App\todo\Infrastructure\Notification;

use App\todo\Domain\NotificationInterface;

final class EmailNotification implements NotificationInterface
{
    public function notify(): void
    {
        // TODO: Implement notify() method.
    }
}
