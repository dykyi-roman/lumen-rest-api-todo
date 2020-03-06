<?php

declare(strict_types=1);

namespace App\todo\Application\Handler;

use App\todo\Application\Command\UpdateTodoCommand;
use App\todo\Domain\Todo\Repository\TodoRepositoryInterface;

final class UpdateTodoHandler
{
    private TodoRepositoryInterface $todoRepository;

    public function __construct(TodoRepositoryInterface $todoRepository)
    {
        $this->todoRepository = $todoRepository;
    }

    public function handle(UpdateTodoCommand $command): void
    {
        $this->todoRepository->updateTodo($command->getTodoId(), $command);
    }
}
