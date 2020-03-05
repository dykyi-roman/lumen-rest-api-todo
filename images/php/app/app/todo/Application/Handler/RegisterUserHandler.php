<?php

namespace App\todo\Application\Handler;

use App\todo\Application\Command\RegisterUserCommand;
use App\todo\Domain\User\UserRepositoryInterface;

final class RegisterUserHandler
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handle(RegisterUserCommand $command): void
    {
        $this->userRepository->createNewUser($command);
    }
}
