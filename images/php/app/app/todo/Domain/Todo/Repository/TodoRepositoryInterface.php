<?php

declare(strict_types=1);

namespace App\todo\Domain\Todo\Repository;

use App\todo\Domain\Todo\Model\Todo;
use App\todo\Application\Command\CreateTodoCommand;
use App\todo\Application\Command\UpdateTodoCommand;

interface TodoRepositoryInterface
{
    public function getAll(): iterable;

    public function createTodo(CreateTodoCommand $command): ?Todo;

    public function updateTodo(string $uuid, UpdateTodoCommand $command): void;

    public function deleteTodo(string $uuid): bool;

    public function show(string $uuid): ?Todo;

    public function getByName(string $name): ?Todo;

    /**
     * @param string $userUuid
     * @param array $filters
     *
     * @return Todo[] iterable
     */
    public function findByFilters(string $userUuid, array $filters = []): iterable;
}
