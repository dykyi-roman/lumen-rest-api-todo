<?php

declare(strict_types=1);

namespace App\todo\Application\Handler;

use App\todo\Domain\Todo\Exceptions\TodoNotFoundExcaption;
use App\todo\Application\Command\DeleteTodoCommand;
use App\todo\Domain\Todo\Repository\TodoRepositoryInterface;

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
        $result = $this->todoRepository->deleteTodo($command->getUuid());
        if (!$result) {
            throw new TodoNotFoundExcaption(self::TODO_NOT_FOUND_EXCEPTION);
        }
    }
}
