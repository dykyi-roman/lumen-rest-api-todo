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
        $todo = new Todo();
        $todo->name = $command->getName();
        $todo->description = $command->getDescription();
        $todo->category = $command->getCategory();
        $todo->status = $command->getStatus();
        $todo->datetime = $command->getDatetime();
        $todo->user_id = $command->getUserId();

        $this->todo[count($this->todo) + 1] = $todo;
        return $todo;
    }

    public function deleteTodo(int $id): bool
    {
        if (isset($this->todo[$id]))
        {
            unset($this->todo[$id]);
            return true;
        }

        return false;
    }

    public function show(int $id): ?Todo
    {
        return 0 === $id ? null : $this->todo[$id];
    }

    /**
     * @param int   $id
     * @param array $filters
     *
     * @return Todo[] iterable
     */
    public function findByFilters(int $id, array $filters = []): iterable
    {
        $iterator = new \ArrayIterator();

        return $iterator;
    }

    public function updateTodo(int $id, UpdateTodoCommand $command): void
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

