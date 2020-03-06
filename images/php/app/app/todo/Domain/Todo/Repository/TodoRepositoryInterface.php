<?php

declare(strict_types=1);

namespace App\todo\Domain\Todo\Repository;

use App\Todo;
use App\todo\Application\Command\CreateTodoCommand;
use App\todo\Application\Command\UpdateTodoCommand;

interface TodoRepositoryInterface
{
    public function createTodo(CreateTodoCommand $command): ?Todo;

    public function updateTodo(int $id, UpdateTodoCommand $command): void;

    public function deleteTodo(int $id): bool;

    public function show(int $id): ?Todo;

    /**
     * @param int   $userId
     * @param array $filters
     *
     * @return Todo[] iterable
     */
    public function findByFilters(int $userId, array $filters = []): iterable;
}
