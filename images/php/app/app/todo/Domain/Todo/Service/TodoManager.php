<?php

declare(strict_types=1);

namespace App\todo\Domain\Todo\Service;

use App\Todo;
use App\todo\Domain\Todo\Exceptions\CreateTodoValidationException;
use App\todo\Application\Command\CreateTodoCommand;
use App\todo\Application\Command\DeleteTodoCommand;
use App\todo\Application\Command\UpdateTodoCommand;
use App\todo\Application\Handler\CreateTodoHandler;
use App\todo\Application\Handler\DeleteTodoHandler;
use App\todo\Application\Handler\UpdateTodoHandler;
use App\todo\Domain\Todo\Repository\TodoRepositoryInterface;
use App\todo\Domain\Todo\Validator\CreateTodoValidator;
use Joselfonseca\LaravelTactician\CommandBusInterface;

final class TodoManager
{
    private const FILTER_ACCESS_FIELDS = ['status', 'category', 'datetime'];

    private CommandBusInterface $bus;

    private array $middleware = [
        CreateTodoValidator::class
    ];

    private int $userId;

    public function __construct(int $userId)
    {
        $this->userId = $userId;
        $this->bus = app(CommandBusInterface::class);
        $this->bus->addHandler(CreateTodoCommand::class, CreateTodoHandler::class);
        $this->bus->addHandler(DeleteTodoCommand::class, DeleteTodoHandler::class);
        $this->bus->addHandler(UpdateTodoCommand::class, UpdateTodoHandler::class);
    }

    public static function init(int $userId): self
    {
        return new self($userId);
    }

    /**
     * @param array $data
     *
     * @throws CreateTodoValidationException
     */
    public function create(array $data = []): void
    {
        $data = array_merge($data, ['user_id' => $this->userId]);
        $this->bus->dispatch(CreateTodoCommand::class, $data, $this->middleware);
    }

    public function update(int $id, array $data = []): void
    {
        $this->middleware = [];
        $data = array_merge($data, ['todo_id' => $id]);
        $this->bus->dispatch(UpdateTodoCommand::class, $data, $this->middleware);
    }

    public function show(int $id): ?Todo
    {
        /** @var TodoRepositoryInterface $todoRepository */
        $todoRepository = app(TodoRepositoryInterface::class);

        return $todoRepository->show($id);
    }

    /**
     * @param array $criteria
     *
     * @return Todo[] iterable
     */
    public function filterBy(array $criteria = []): iterable
    {
        foreach ($criteria as $key => $value) {
            if (!in_array($key, self::FILTER_ACCESS_FIELDS, true)) {
                unset($criteria[$key]);
            }
        }

        /** @var TodoRepositoryInterface $todoRepository */
        $todoRepository = app(TodoRepositoryInterface::class);

        return $todoRepository->findByFilters($this->userId, $criteria);
    }

    public function delete(array $data = []): void
    {
        $this->middleware = [];
        $this->bus->dispatch(DeleteTodoCommand::class, $data, $this->middleware);
    }
}
