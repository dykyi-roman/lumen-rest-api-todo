<?php

declare(strict_types=1);

namespace App\todo\Infrastructure\Repositories\Eloquent;

use App\Todo;
use App\todo\Application\Command\CreateTodoCommand;
use App\todo\Application\Command\UpdateTodoCommand;
use App\todo\Domain\Todo\TodoRepositoryInterface;

final class TodoRepository implements TodoRepositoryInterface
{
    public function createTodo(CreateTodoCommand $command): void
    {
        $todo = new Todo();
        $todo->name = $command->getName();
        $todo->description = $command->getDescription();
        $todo->category = $command->getCategory();
        $todo->status = $command->getStatus();
        $todo->datetime = $command->getDatetime();
        $todo->user_id = $command->getUserId();
        $todo->save();
    }

    public function deleteTodo(int $id): bool
    {
        return 0 !== Todo::destroy($id);
    }

    public function show(int $id): ?Todo
    {
        return Todo::where('id', $id)->first();
    }

    public function updateTodo(int $id, UpdateTodoCommand $command): void
    {
        Todo::find($id)->fill(array_filter($command->toArray()))->save();
    }
}

