<?php

declare(strict_types=1);

namespace App\todo\Application\Command;

/**
 * @see CreateTodoHandler
 */
final class CreateTodoCommand
{
    private string $name;

    private string $description;

    private string $datetime;

    private string $status;

    private string $category;

    private string $user_uuid;

    private string $uuid;

    public function __construct(
        string $user_uuid,
        string $name,
        string $description,
        string $datetime,
        string $status,
        string $category,
        string $uuid
    ) {
        $this->user_uuid = $user_uuid;
        $this->name = $name;
        $this->description = $description;
        $this->datetime = $datetime;
        $this->status = $status;
        $this->category = $category;
        $this->uuid = $uuid;
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

    public function getUserId(): string
    {
        return $this->user_uuid;
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

    public function getUuid(): string
    {
        return $this->uuid;
    }
}
