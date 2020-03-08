<?php

declare(strict_types=1);

namespace App\todo\Domain\User\Service;

use App\todo\Domain\User\Exceptions\LoginUserValidationException;
use App\todo\Domain\User\Repository\UserRepositoryInterface;
use App\todo\Domain\User\Model\Users;
use App\todo\Domain\User\Validator\LoginUserValidator;
use Illuminate\Support\Facades\Hash;

final class LoginUser
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param string $email
     * @param string $password
     *
     * @return Users
     *
     * @throws LoginUserValidationException
     */
    public function login(string $email, string $password): Users
    {
        LoginUserValidator::validate([
            'email' => $email,
            'password' => $password,
        ]);

        $user = $this->userRepository->findUserByEmail($email);
        if (null === $user) {
            throw new LoginUserValidationException('User not found');
        }

        if (Hash::check($password, $user->password)) {
            $token = TokenGenerator::generate();
            $this->userRepository->refreshApiToken($email, $token);
            $user->api_token = $token;

            return $user;
        }

        throw new LoginUserValidationException('User not found');
    }
}
