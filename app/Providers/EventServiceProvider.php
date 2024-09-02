<?php

namespace App\Providers;

use App\Events\RegistrationSuccessful;
use App\Listeners\SubscribeUserToMailchimp;
use App\Events\PublishedPost;
use App\Listeners\SendEmailToFollowers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        RegistrationSuccessful::class => [
            SubscribeUserToMailchimp::class,
        ],

        PublishedPost::class => [
            SendEmailToFollowers::class,
        ],

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
