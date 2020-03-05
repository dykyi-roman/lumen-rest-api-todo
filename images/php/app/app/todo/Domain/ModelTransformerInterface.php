<?php

declare(strict_types=1);

namespace App\todo\Domain;

interface ModelTransformerInterface
{
    public function transform(): array;
}
