<?php

namespace App\Providers;

use App\Events\ReferenceMail;
use App\Events\WishGrantedMail;
use App\Events\DeclineMail;
use App\Events\NewRequest;
use App\Listeners\SendNewRequestMail;
use App\Listeners\SendReferenceNumber;
use App\Listeners\SendGrantedMail;
use App\Listeners\SendDeclinedMail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

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
        ReferenceMail::class => [
            SendReferenceNumber::class,
        ],
        WishGrantedMail::class => [
            SendGrantedMail::class,
        ],
        DeclineMail::class => [
            SendDeclinedMail::class,
        ],
        NewRequest::class => [
            SendNewRequestMail::class,
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
