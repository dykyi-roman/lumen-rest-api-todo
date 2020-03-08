<?php

declare(strict_types=1);

namespace App\todo\Domain\User\Validator;

use App\todo\Domain\User\Exceptions\LoginUserValidationException;
use Illuminate\Support\Facades\Validator;

final class LoginUserValidator
{
    protected array $rules = [
        'email' => 'required|email',
        'password' => 'required|min:3',
    ];

    private function __construct()
    {
        //MOCK
    }

    /**
     * @param array $data
     * @throws LoginUserValidationException
     */
    public static function validate(array $data): void
    {
        (new self())->execute($data);
    }

    /**
     * @param array $command
     * @throws LoginUserValidationException
     */
    public function execute(array $command): void
    {
        $validator = Validator::make($command, $this->rules);
        if ($validator->fails()) {
            throw new LoginUserValidationException($validator->errors()->toJson());
        }
    }
}
