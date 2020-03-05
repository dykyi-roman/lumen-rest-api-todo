<?php

namespace App\Providers;

use App\Events\UserRegisteredEvent;
use App\Listeners\UserRegisteredListener;
use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        UserRegisteredEvent::class => [UserRegisteredListener::class],
    ];
}
