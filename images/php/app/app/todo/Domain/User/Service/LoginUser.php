<?php

declare(strict_types=1);

namespace App\todo\Domain\User\Service;

use App\todo\Domain\User\Repository\UserRepositoryInterface;
use App\todo\Domain\User\Model\Users;
use Illuminate\Support\Facades\Hash;

final class LoginUser
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login(string $email, string $password): ?Users
    {
        $user = $this->userRepository->findUserByEmail($email);
        if (null === $user) {
            return null;
        }

        if (Hash::check($password, $user->password)) {
            $token = TokenGenerator::generate();
            $this->userRepository->refreshApiToken($email, $token);
            $user->api_token = $token;

            return $user;
        }

        return null;
    }
}
