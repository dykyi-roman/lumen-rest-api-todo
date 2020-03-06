<?php

namespace App\todo\Domain\Todo;

use App\todo\Domain\Todo\Model\Todo;

final class TodoMapper
{
    private function __construct()
    {
    }

    public static function init(): self
    {
        return new self();
    }

    public function map(iterable $iterator): array
    {
        return array_map(static function (Todo $todo) {
            return (new TodoApiTransformer($todo))->transform();
        }, iterator_to_array($iterator));
    }
}
