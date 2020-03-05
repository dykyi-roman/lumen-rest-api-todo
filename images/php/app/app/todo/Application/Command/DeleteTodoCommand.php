<?php

declare(strict_types=1);

namespace App\todo\Application\Command;

/**
 * @see DeleteTodoHandler
 */
final class DeleteTodoCommand
{
    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
