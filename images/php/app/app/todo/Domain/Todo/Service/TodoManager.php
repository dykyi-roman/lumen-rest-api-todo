<?php

declare(strict_types=1);

namespace App\todo\Domain\Todo\Service;

use App\todo\Domain\Todo\Model\Todo;
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

    private string $userUuid;

    public function __construct(string $userUuid)
    {
        $this->userUuid = $userUuid;
        $this->bus = app(CommandBusInterface::class);
        $this->bus->addHandler(CreateTodoCommand::class, CreateTodoHandler::class);
        $this->bus->addHandler(DeleteTodoCommand::class, DeleteTodoHandler::class);
        $this->bus->addHandler(UpdateTodoCommand::class, UpdateTodoHandler::class);
    }

    public static function init(string $userUuid): self
    {
        return new self($userUuid);
    }

    /**
     * @param array $data
     * @param string $uuid
     *
     * @throws CreateTodoValidationException
     */
    public function create(string $uuid, array $data = []): void
    {
        $data = array_merge($data, ['user_uuid' => $this->userUuid, 'uuid' => $uuid]);
        $this->bus->dispatch(CreateTodoCommand::class, $data, $this->middleware);
    }

    public function update(string $uuid, array $data = []): void
    {
        $this->middleware = [];
        $data = array_merge($data, ['todo_uuid' => $uuid]);
        $this->bus->dispatch(UpdateTodoCommand::class, $data, $this->middleware);
    }

    public function show(string $uuid): ?Todo
    {
        /** @var TodoRepositoryInterface $todoRepository */
        $todoRepository = app(TodoRepositoryInterface::class);

        return $todoRepository->show($uuid);
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

        return $todoRepository->findByFilters($this->userUuid, $criteria);
    }

    public function delete(array $data = []): void
    {
        $this->middleware = [];
        $this->bus->dispatch(DeleteTodoCommand::class, $data, $this->middleware);
    }
}
