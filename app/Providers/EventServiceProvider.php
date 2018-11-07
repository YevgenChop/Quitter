<?php

namespace App\Providers;

use App\Events\ReplyCreated;
use App\Listeners\ReplyCreatedEventListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        ReplyCreated::class => [
            ReplyCreatedEventListener::class,
        ],
    ];
}
