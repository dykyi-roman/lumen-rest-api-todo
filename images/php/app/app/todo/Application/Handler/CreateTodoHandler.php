<?php

declare(strict_types=1);

namespace App\todo\Application\Handler;

use App\todo\Domain\Todo\Event\TodoCreatedEvent;
use App\todo\Application\Command\CreateTodoCommand;
use App\todo\Domain\Todo\Repository\TodoRepositoryInterface;
use Illuminate\Support\Facades\Event;

final class CreateTodoHandler
{
    private TodoRepositoryInterface $todoRepository;

    private Event $event;

    public function __construct(TodoRepositoryInterface $todoRepository,  Event $event)
    {
        $this->event = $event;
        $this->todoRepository = $todoRepository;
    }

    public function handle(CreateTodoCommand $command): void
    {
        $todo = $this->todoRepository->createTodo($command);
        if ($todo){
            $this->event::dispatch(new TodoCreatedEvent($todo));
        }
    }
}
