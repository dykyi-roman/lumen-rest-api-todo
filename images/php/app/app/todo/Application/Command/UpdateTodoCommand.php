<?php

declare(strict_types=1);

namespace App\todo\Application\Command;

/**
 * @see UpdateTodoHandler
 */
final class UpdateTodoCommand
{
    private string $name;

    private string $description;

    private string $datetime;

    private string $status;

    private string $category;

    private string $todo_uuid;

    public function __construct(
        string $todo_uuid,
        string $name = '',
        string $description = '',
        string $datetime = '',
        string $status = '',
        string $category = ''
    ) {
        $this->todo_uuid = $todo_uuid;
        $this->name = $name;
        $this->description = $description;
        $this->datetime = $datetime;
        $this->status = $status;
        $this->category = $category;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->getName(),
            'description' => $this->getDescription(),
            'datetime' => $this->getDatetime(),
            'status' => $this->getStatus(),
            'category' => $this->getCategory(),
        ];
    }

    public function getTodoId(): string
    {
        return $this->todo_uuid;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getDatetime(): string
    {
        return $this->datetime;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getCategory(): string
    {
        return $this->category;
    }


}
