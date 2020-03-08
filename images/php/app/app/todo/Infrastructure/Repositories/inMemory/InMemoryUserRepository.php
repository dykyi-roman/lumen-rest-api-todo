<?php

declare(strict_types=1);

namespace App\todo\Infrastructure\Repositories\inMemory;

use App\todo\Application\Command\RegisterUserCommand;
use App\todo\Domain\User\Repository\UserRepositoryInterface as UserRepositoryInterfaceAlias;
use App\todo\Domain\User\Model\Users;
use Illuminate\Support\Facades\Hash;

final class InMemoryUserRepository implements UserRepositoryInterfaceAlias
{
    private array $users = [];

    public function createNewUser(RegisterUserCommand $command): ?Users
    {
        $user = new Users(['uuid' => $command->getUuid()]);
        $user->first_name = $command->getFirstName();
        $user->last_name = $command->getLastName();
        $user->mobile_number = $command->getMobileNumber();
        $user->gender = $command->getGender();
        $user->birthday = $command->getBirthday();
        $user->password = Hash::make($command->getPassword());
        $user->email = $command->getEmail();
        $user->api_token = $command->getToken();

        $this->users[$command->getUuid()] = $user;

        return $user;
    }

    public function clearToken(string $email): void
    {
        // TODO
    }

    public function findUserByEmail(string $email): ?Users
    {
        foreach ($this->users as $id => $user) {
            if ($user->email === $email) {
                return $user;
            }
        }

        return null;
    }

    public function findUserByApiToken(string $token): ?Users
    {
        foreach ($this->users as $id => $user) {
            if ($user->api_token === $token) {
                return $user;
            }
        }

        return null;
    }

    public function refreshApiToken(string $email, string $token): void
    {
        foreach ($this->users as $id => $user) {
            if ($user->email === $email) {
                $user->api_token = $token;
                $this->users[$id] = $user;
            }
        }
    }

    public function getAll(): iterable
    {
        return new \ArrayIterator($this->users);
    }
}

