<?php

use App\todo\Application\Command\CreateTodoCommand;
use App\todo\Application\Command\DeleteTodoCommand;
use App\todo\Application\Handler\DeleteTodoHandler;
use App\todo\Domain\Todo\Exceptions\TodoNotFoundExcaption;
use App\todo\Infrastructure\Repositories\inMemory\InMemoryTodoRepository;

/**
 * @coversDefaultClass DeleteTodoHandler
 */
class DeleteTodoHandlerTest extends TestCase
{

    /**
     * @covers ::handle
     *
     * @throws TodoNotFoundExcaption
     */
    public function testTodoDeleteFailed(): void
    {
        $this->expectException(TodoNotFoundExcaption::class);

        $handler = new DeleteTodoHandler(new InMemoryTodoRepository());
        $handler->handle(new DeleteTodoCommand(1442));
    }

    /**
     * @throws TodoNotFoundExcaption
     *
     * @covers ::handle
     */
    public function testTodoDeleteSuccess(): void
    {
        $todoRepository = new InMemoryTodoRepository();
        $todoCommand = new CreateTodoCommand(
            'test-user-id',
            'test-user-name',
            'test-user-desc',
            '2020-01-01',
            'new',
            'new',
        );

        $todoRepository->createTodo($todoCommand);
        $this->assertEquals(1, $todoRepository->getAll()->count());
        $handler = new DeleteTodoHandler($todoRepository);
        $handler->handle(new DeleteTodoCommand(1));
        $this->assertEquals(0, $todoRepository->getAll()->count());
    }
}
