<?php

declare(strict_types=1);

namespace App\todo\Application\Handler;

use App\todo\Application\Command\ClearUserTokenCommand;
use App\todo\Domain\User\Repository\UserRepositoryInterface;

final class ClearUserTokenHandler
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handle(ClearUserTokenCommand $command): void
    {
        $this->userRepository->clearToken($command->getEmail());
    }
}
