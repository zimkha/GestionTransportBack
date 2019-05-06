<?php

namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use App\Events\NotificationUserMail;
use App\Events\RegisterClient;
use App\Listeners\RegisterClientListener;
use App\Listeners\NotificationUserMailListener;
use Illuminate\Auth\Events\Login;
use App\Events\RegsiterCommande;
use App\Listeners\RegisterCommandeListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        NotificationUserMail::class => [
                NotificationUserMailListener::class
        ],
        RegisterClient::class => [
                RegisterClientListener::class,
        ],
        RegsiterCommande::class => [
                RegisterCommandeListener::class,
        ]

        

      
       
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
       
         parent::boot();

        //
    }
    public function shouldDiscoverEvents()
    {
        return true;
    }
}

