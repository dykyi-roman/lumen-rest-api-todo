<?php

declare(strict_types = 1);

namespace App;

use Illuminate\Database\Eloquent\Model;

class ToDo extends Model
{
    protected string $table = 'todo';

    protected array $fillable = ['name', 'description', 'datetime', 'status', 'category'];
}
