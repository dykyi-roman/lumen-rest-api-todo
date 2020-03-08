<?php

declare(strict_types=1);

namespace App\todo\Application\Command;

/**
 * @see DeleteTodoHandler
 */
final class DeleteTodoCommand
{
    private string $uuid;

    public function __construct(string $uuid)
    {
        $this->uuid = $uuid;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }
}
