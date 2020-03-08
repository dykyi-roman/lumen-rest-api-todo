<?php

use App\todo\Application\Command\RegisterUserCommand;
use App\todo\Application\Handler\RegisterUserHandler;
use App\todo\Domain\User\Event\UserRegisteredEvent;
use App\todo\Infrastructure\Repositories\inMemory\InMemoryUserRepository;
use Faker\Provider\Uuid;
use Illuminate\Support\Facades\Event;

/**
 * @coversDefaultClass RegisterUserHandler
 */
class RegisterUserHandlerTest extends TestCase
{
    /**
     * @covers ::handle
     */
    public function testUserRegisterSuccess(): void
    {
        Event::fake();
        $handler = new RegisterUserHandler(new InMemoryUserRepository(), new Event());
        $todoCommand = new RegisterUserCommand(
            Uuid::uuid(),
            'test-user-name',
            'test-user-laste-name',
            '+380948982443',
            'man',
            '2020-01-01',
            'test@gmail.com',
            'newnewnew',
            'newnewnew',
        );
        $handler->handle($todoCommand);
        Event::assertDispatched(UserRegisteredEvent::class);
    }
}
