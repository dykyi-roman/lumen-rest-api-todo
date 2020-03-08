<?php

declare(strict_types=1);

namespace App\todo\Infrastructure\Repositories\Eloquent;

use App\todo\Domain\Todo\Model\Todo;
use App\todo\Application\Command\CreateTodoCommand;
use App\todo\Application\Command\UpdateTodoCommand;
use App\todo\Domain\Todo\Repository\TodoRepositoryInterface;

final class TodoRepository implements TodoRepositoryInterface
{
    public function createTodo(CreateTodoCommand $command): ?Todo
    {
        $todo = new Todo(['uuid' => $command->getUuid()]);
        $todo->name = $command->getName();
        $todo->description = $command->getDescription();
        $todo->category = $command->getCategory();
        $todo->status = $command->getStatus();
        $todo->datetime = $command->getDatetime();
        $todo->user_uuid = $command->getUserId();

        if ($todo->save()) {
            return $todo;
        }

        return null;
    }

    public function deleteTodo(string $uuid): bool
    {
        return 0 !== Todo::destroy($uuid);
    }

    public function show(string $uuid): ?Todo
    {
        return Todo::where('uuid', $uuid)->first();
    }

    /**
     * @param string $uuid
     * @param array $filters
     *
     * @return Todo[] iterable
     */
    public function findByFilters(string $uuid, array $filters = []): iterable
    {
        if (empty($filters)) {
            return Todo::where('user_uuid', $uuid)->get();
        }

        $todo = Todo::query();
        foreach ($filters as $key => $value) {
            $todo = $todo->where($key, $value);
        }

        return $todo->get();
    }

    public function updateTodo(string $uuid, UpdateTodoCommand $command): void
    {
        Todo::find($uuid)->fill(array_filter($command->toArray()))->save();
    }

    public function getByName(string $name): ?Todo
    {
        return Todo::where('name', $name)->first();
    }

    public function getAll(): iterable
    {
        return Todo::all();
    }
}

