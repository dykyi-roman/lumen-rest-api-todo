<?php

namespace App\todo\Application\Handler;

use App\todo\Application\Command\CreateTodoCommand;
use App\todo\Domain\Todo\TodoRepositoryInterface;

final class CreateTodoHandler
{
    private TodoRepositoryInterface $todoRepository;

    public function __construct(TodoRepositoryInterface $todoRepository)
    {
        $this->todoRepository = $todoRepository;
    }

    public function handle(CreateTodoCommand $command): void
    {
        $this->todoRepository->createTodo($command);
    }
}
