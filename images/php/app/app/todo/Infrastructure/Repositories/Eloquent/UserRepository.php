<?php

declare(strict_types=1);

namespace App\todo\Infrastructure\Repositories\Eloquent;

use App\Exceptions\UserNotFoundException;
use App\todo\Application\Command\RegisterUserCommand;
use App\todo\Domain\User\UserRepositoryInterface;
use App\Users;
use Illuminate\Support\Facades\Hash;

final class UserRepository implements UserRepositoryInterface
{
    public function createNewUser(RegisterUserCommand $command): void
    {
        $user = new Users();
        $user->first_name = $command->getFirstName();
        $user->last_name = $command->getLastName();
        $user->mobile_number = $command->getMobileNumber();
        $user->gender = $command->getGender();
        $user->birthday = $command->getBirthday();
        $user->password = Hash::make($command->getPassword());
        $user->email = $command->getEmail();
        $user->api_token = $command->getToken();

        $user->save();
    }

    public function clearToken(string $email): void
    {
        $user = Users::where('email', $email)->first();
        if (null === $user) {
            throw new UserNotFoundException('User not found');
        }

        Users::where('email', $email)->update(['api_token' => '']);
    }

    public function findUserByEmail(string $email): ?Users
    {
        return Users::where('email', $email)->first();
    }

    public function findUserByApiToken(string $token): ?Users
    {
        return Users::where('api_token', $token)->first();
    }

    public function refreshApiToken(string $email, string $token): void
    {
        Users::where('email', $email)->update(['api_token' => $token]);
    }
}

