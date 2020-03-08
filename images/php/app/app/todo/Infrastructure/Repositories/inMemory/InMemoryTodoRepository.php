<?php

declare(strict_types=1);

namespace App\todo\Infrastructure\Repositories\inMemory;

use App\todo\Domain\Todo\Model\Todo;
use App\todo\Application\Command\CreateTodoCommand;
use App\todo\Application\Command\UpdateTodoCommand;
use App\todo\Domain\Todo\Repository\TodoRepositoryInterface;

final class InMemoryTodoRepository implements TodoRepositoryInterface
{
    private array $todo = [];

    public function createTodo(CreateTodoCommand $command): ?Todo
    {
        $todo = new Todo(['uuid' => $command->getUuid()]);
        $todo->name = $command->getName();
        $todo->description = $command->getDescription();
        $todo->category = $command->getCategory();
        $todo->status = $command->getStatus();
        $todo->datetime = $command->getDatetime();
        $todo->user_id = $command->getUserId();

        $this->todo[$command->getUuid()] = $todo;

        return $todo;
    }

    public function deleteTodo(string $uuid): bool
    {
        if (isset($this->todo[$uuid]))
        {
            unset($this->todo[$uuid]);
            return true;
        }

        return false;
    }

    public function show(string $uuid): ?Todo
    {
        return 0 === $uuid ? null : $this->todo[$uuid];
    }

    /**
     * @param string $uuid
     * @param array $filters
     *
     * @return Todo[] iterable
     */
    public function findByFilters(string $uuid, array $filters = []): iterable
    {
        $iterator = new \ArrayIterator();

        return $iterator;
    }

    public function updateTodo(string $uuid, UpdateTodoCommand $command): void
    {
        // TODO
    }

    public function getByName(string $name): ?Todo
    {
        // TODO
    }

    public function getAll(): iterable
    {
        return new \ArrayIterator($this->todo);
    }
}

