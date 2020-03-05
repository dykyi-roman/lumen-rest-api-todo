<?php

namespace App\Providers;

use App\todo\Domain\Todo\TodoRepositoryInterface;
use App\todo\Domain\User\UserRepositoryInterface;
use App\todo\Infrastructure\Repositories\Eloquent\TodoRepository;
use App\todo\Infrastructure\Repositories\Eloquent\UserRepository;
use Illuminate\Support\ServiceProvider;

final class BackendServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(TodoRepositoryInterface::class, TodoRepository::class);
    }
}
