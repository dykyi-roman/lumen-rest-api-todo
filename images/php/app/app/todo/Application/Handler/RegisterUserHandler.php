<?php

namespace App\todo\Application\Handler;

use App\Events\UserRegisteredEvent;
use App\todo\Application\Command\RegisterUserCommand;
use App\todo\Domain\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Event;

final class RegisterUserHandler
{
    private UserRepositoryInterface $userRepository;
    /**
     * @var Event
     */
    private Event $event;

    public function __construct(UserRepositoryInterface $userRepository, Event $event)
    {
        $this->event = $event;
        $this->userRepository = $userRepository;
    }

    public function handle(RegisterUserCommand $command): void
    {
        $user = $this->userRepository->createNewUser($command);
        if ($user) {
            $this->event::dispatch(new UserRegisteredEvent($user));
        }
    }
}
