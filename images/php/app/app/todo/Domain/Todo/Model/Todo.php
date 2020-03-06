<?php

declare(strict_types = 1);

namespace App\todo\Domain\Todo\Model;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected string $table = 'todo';

    protected array $fillable = ['name', 'description', 'datetime', 'status', 'category'];
}