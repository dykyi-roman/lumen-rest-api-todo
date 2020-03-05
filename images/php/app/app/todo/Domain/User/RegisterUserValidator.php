<?php

namespace App\todo\Domain\User;

use App\Exceptions\RegisterUserValidationException;
use Illuminate\Support\Facades\Validator;
use League\Tactician\Middleware;

final class RegisterUserValidator implements Middleware
{
    protected array $rules = [
        'first_name' => 'required',
        'last_name' => 'required',
        'mobile_number' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:3',
    ];

    /**
     * @param object   $command
     * @param callable $next
     *
     * @return mixed
     * @throws RegisterUserValidationException
     */
    public function execute($command, callable $next)
    {
        $validator = Validator::make($command->toArray(), $this->rules);
        if ($validator->fails()) {
            throw new RegisterUserValidationException($validator->errors()->toJson());
        }

        return $next($command);
    }
}
