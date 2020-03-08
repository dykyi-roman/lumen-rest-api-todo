<?php

declare(strict_types=1);

namespace App\todo\Domain;

use Illuminate\Support\Str;

trait Uuid
{
    /**
     * The "booting" method of the model, This help to magically create uuid for all new models
     *
     * @return void
     */
    public static function boot(): void
    {
        parent::boot();
        self::creating(static function ($model) {
            if (null === $model->uuid || '' === $model->uuid) {
                $model->uuid = Str::uuid()->toString();
            }
        });
    }

    /**
     * Get the value indicating whether the IDs are incrementing.
     */
    public function getIncrementing(): bool
    {
        return false;
    }

    /**
     * Get the primary key for the model.
     */
    public function getKeyName(): string
    {
        return 'uuid';
    }

    /**
     * Get the auto-incrementing key type.
     */
    public function getKeyType(): string
    {
        return 'string';
    }
}
