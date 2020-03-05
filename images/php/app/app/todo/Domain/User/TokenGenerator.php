<?php

namespace App\todo\Domain\User;

use Illuminate\Support\Str;

final class TokenGenerator
{
    private const ALGORITHM = 'sha256';

    public static function generate(): string
    {
        $generateRandomString = Str::random(60);

        return hash(self::ALGORITHM, $generateRandomString);
    }
}
