<?php

namespace App\Providers;

use App\todo\Domain\NotificationInterface;
use App\todo\Domain\Todo\Repository\TodoRepositoryInterface;
use App\todo\Domain\User\Repository\UserRepositoryInterface;
use App\todo\Infrastructure\Notification\EmailNotification;
use App\todo\Infrastructure\Repositories\Eloquent\InMemoryTodoRepository;
use App\todo\Infrastructure\Repositories\Eloquent\UserRepository;
use Illuminate\Support\ServiceProvider;

final class BackendServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(TodoRepositoryInterface::class, InMemoryTodoRepository::class);
        $this->app->bind(NotificationInterface::class, EmailNotification::class);
    }
}
