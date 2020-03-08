<?php

declare(strict_types=1);

namespace App\todo\Application\Command;

/**
 * @see RegisterUserHandler
 */
final class RegisterUserCommand
{
    private string $first_name;
    private string $last_name;
    private string $mobile_number;
    private string $gender;
    private string $birthday;
    private string $email;
    private string $password;
    private string $token;
    private string $uuid;

    public function __construct(
        string $first_name,
        string $last_name,
        string $mobile_number,
        string $gender,
        string $birthday,
        string $email,
        string $password,
        string $token,
        string $uuid
    )
    {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->mobile_number = $mobile_number;
        $this->gender = $gender;
        $this->birthday = $birthday;
        $this->email = $email;
        $this->password = $password;
        $this->token = $token;
        $this->uuid = $uuid;
    }

    public function toArray(): array
    {
        return [
            'first_name' => $this->getFirstName(),
            'last_name' => $this->getLastName(),
            'email' => $this->getEmail(),
            'birthday' => $this->getBirthday(),
            'gender' => $this->getGender(),
            'mobile_number' => $this->getMobileNumber(),
            'password' => $this->getPassword(),
        ];
    }

    public function getFirstName(): string
    {
        return $this->first_name;
    }

    public function getLastName(): string
    {
        return $this->last_name;
    }

    public function getMobileNumber(): string
    {
        return $this->mobile_number;
    }

    public function getGender(): string
    {
        return $this->gender;
    }

    public function getBirthday(): string
    {
        return $this->birthday;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }
}

