<?php

declare(strict_types=1);

namespace App\todo\Domain\Todo;

use App\Todo;
use App\todo\Application\Command\CreateTodoCommand;
use App\todo\Application\Command\UpdateTodoCommand;

interface TodoRepositoryInterface
{
    public function createTodo(CreateTodoCommand $command): void;

    public function updateTodo(int $id, UpdateTodoCommand $command): void;

    public function deleteTodo(int $id): bool;

    public function show(int $id): ?Todo;
}
