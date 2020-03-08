<?php

use App\todo\Application\Command\CreateTodoCommand;
use App\todo\Application\Handler\CreateTodoHandler;
use App\todo\Domain\Todo\Event\TodoCreatedEvent;
use App\todo\Infrastructure\Repositories\inMemory\InMemoryTodoRepository;
use Faker\Provider\Uuid;
use Illuminate\Support\Facades\Event;

/**
 * @coversDefaultClass \App\todo\Application\Handler\CreateTodoHandler
 */
class CreateTodoHandlerTest extends TestCase
{
    /**
     * @covers ::handle
     */
    public function testTodoCreateSuccess(): void
    {
        Event::fake();
        $handler = new CreateTodoHandler(new InMemoryTodoRepository(), new Event());
        $command = new CreateTodoCommand(
            Uuid::uuid(),
            'test-user-id',
            'test-user-name',
            'test-user-desc',
            '2020-01-01',
            'new',
            'new',
        );

        $handler->handle($command);
        Event::assertDispatched(TodoCreatedEvent::class);
    }
}
