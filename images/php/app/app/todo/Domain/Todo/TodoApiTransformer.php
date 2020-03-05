<?php

declare(strict_types=1);

namespace App\todo\Domain\Todo;

use App\Todo;
use App\todo\Domain\ModelTransformerInterface;

final class TodoApiTransformer implements ModelTransformerInterface
{
    private Todo $todo;

    public function __construct(Todo $todo)
    {
        $this->todo = $todo;
    }

    public function transform(): array
    {
        return [
            'name' => $this->todo->name,
            'description' => $this->todo->description,
            'datetime' => $this->todo->datetime,
            'status' => $this->todo->status,
            'category' => $this->todo->category,
        ];
    }
}
