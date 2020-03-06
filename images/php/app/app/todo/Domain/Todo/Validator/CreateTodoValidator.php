<?php

declare(strict_types=1);

namespace App\todo\Domain\Todo\Validator;

use App\todo\Domain\User\Exceptions\RegisterUserValidationException;
use Illuminate\Support\Facades\Validator;
use League\Tactician\Middleware;

final class CreateTodoValidator implements Middleware
{
    protected array $rules = [
        'name' => 'required',
        'status' => 'required',
        'category' => 'required',
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

