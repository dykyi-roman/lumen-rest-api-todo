<?php

declare(strict_types=1);

namespace App\todo\Domain\Todo\Model;

use App\todo\Domain\Uuid;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use Uuid;

    protected string $table = 'todo';

    protected array $guarded = ['uuid'];

    protected array $fillable = ['name', 'description', 'datetime', 'status', 'category'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->uuid = $attributes['uuid'] ?? null;
    }
}
