<?php

declare(strict_types=1);

namespace App\todo\Domain\User;

use App\Exceptions\UserNotFoundException;
use App\todo\Application\Command\ClearUserTokenCommand;
use App\todo\Application\Handler\ClearUserTokenHandler;
use Joselfonseca\LaravelTactician\CommandBusInterface;

final class ClearUserToken
{
    private CommandBusInterface $bus;

    public function __construct()
    {
        $this->bus = app(CommandBusInterface::class);
        $this->bus->addHandler(ClearUserTokenCommand::class, ClearUserTokenHandler::class);
    }

    /**
     * @param array $data
     *
     * @throws UserNotFoundException
     */
    public function clear(array $data = []): void
    {
        $this->bus->dispatch(ClearUserTokenCommand::class, $data);

    }
}
