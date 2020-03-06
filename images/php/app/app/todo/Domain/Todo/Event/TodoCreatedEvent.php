<?php

namespace App\todo\Domain\Todo\Event;

use App\Events\Event;
use App\todo\Domain\Todo\Model\Todo;

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
