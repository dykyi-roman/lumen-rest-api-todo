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
        $todo = new Todo();
        $todo->name = $command->getName();
        $todo->description = $command->getDescription();
        $todo->category = $command->getCategory();
        $todo->status = $command->getStatus();
        $todo->datetime = $command->getDatetime();
        $todo->user_id = $command->getUserId();
        if ($todo->save()) {
            return $todo;
        }

        return null;
    }

    public function deleteTodo(int $id): bool
    {
        return 0 !== Todo::destroy($id);
    }

    public function show(int $id): ?Todo
    {
        return Todo::where('id', $id)->first();
    }

    /**
     * @param int   $id
     * @param array $filters
     *
     * @return Todo[] iterable
     */
    public function findByFilters(int $id, array $filters = []): iterable
    {
        if (empty($filters)) {
            return Todo::where('user_id', $id)->get();
        }

        $todo = Todo::query();
        foreach ($filters as $key => $value) {
            $todo = $todo->where($key, $value);
        }

        return $todo->get();
    }

    public function updateTodo(int $id, UpdateTodoCommand $command): void
    {
        Todo::find($id)->fill(array_filter($command->toArray()))->save();
    }

}

