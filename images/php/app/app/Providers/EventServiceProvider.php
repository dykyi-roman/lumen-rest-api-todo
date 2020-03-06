<?php

namespace App\Providers;

use App\todo\Domain\User\Event\UserRegisteredEvent;
use App\todo\Domain\User\Listeners\UserRegisteredListener;
use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        UserRegisteredEvent::class => [UserRegisteredListener::class],
    ];
}
