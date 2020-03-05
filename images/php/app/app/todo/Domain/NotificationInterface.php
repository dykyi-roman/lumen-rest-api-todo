<?php

declare(strict_types=1);

namespace App\todo\Domain;

interface NotificationInterface
{
    public function notify(): void;
}
