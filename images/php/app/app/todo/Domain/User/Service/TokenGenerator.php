<?php

declare(strict_types=1);

namespace App\todo\Domain\User\Service;

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
