<?php

namespace App\Events;

use App\Todo;

class TodoCreatedEvent extends Event
{
    private Todo $todo;

    public function __construct(Todo $todo)
    {
        $this->todo = $todo;
    }

    public function getTodo(): Todo
    {
        return $this->todo;
    }
}
