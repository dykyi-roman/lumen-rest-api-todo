<?php

declare(strict_types=1);

namespace App\todo\Domain\User\Service;

use App\todo\Domain\User\Exceptions\RegisterUserValidationException;
use App\todo\Application\Command\RegisterUserCommand;
use App\todo\Application\Handler\RegisterUserHandler;
use App\todo\Domain\User\Validator\RegisterUserValidator;
use Joselfonseca\LaravelTactician\CommandBusInterface;

final class RegisterUser
{
    private CommandBusInterface $bus;

    private array $middleware = [
        RegisterUserValidator::class
    ];

    private string $token;

    public function __construct(string $token)
    {
        $this->token = $token;
        $this->bus = app(CommandBusInterface::class);
        $this->bus->addHandler(RegisterUserCommand::class, RegisterUserHandler::class);
    }

    /**
     * @param string $uuid
     * @param array  $data
     *
     * @return void
     *
     * @throws RegisterUserValidationException
     */
    public function registerUser(string $uuid, array $data = []): void
    {
        $data = array_merge($data, ['uuid' => $uuid, 'token' => $this->token]);
        $this->bus->dispatch(RegisterUserCommand::class, $data, $this->middleware);
    }

}
