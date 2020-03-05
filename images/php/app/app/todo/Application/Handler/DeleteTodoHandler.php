<?php

namespace App\todo\Application\Handler;

use App\Exceptions\TodoNotFoundExcaption;
use App\todo\Application\Command\DeleteTodoCommand;
use App\todo\Domain\Todo\TodoRepositoryInterface;

final class DeleteTodoHandler
{
    private const TODO_NOT_FOUND_EXCEPTION = 'Todo not found';

    private TodoRepositoryInterface $todoRepository;

    public function __construct(TodoRepositoryInterface $todoRepository)
    {
        $this->todoRepository = $todoRepository;
    }

    /**
     * @param DeleteTodoCommand $command
     *
     * @throws TodoNotFoundExcaption
     */
    public function handle(DeleteTodoCommand $command): void
    {
        $result = $this->todoRepository->deleteTodo($command->getId());
        if (!$result) {
            throw new TodoNotFoundExcaption(self::TODO_NOT_FOUND_EXCEPTION);
        }
    }
}
