<?php

namespace App\Listeners;

use App\Mail\AdminNewRequest;
use App\Mail\EmployeeNewRequest;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendNewRequestMail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
       // creates a mailable instance
        Mail::to('makeawishvgroup@gmail.com')->send(new AdminNewRequest($event->mail_data));

        Mail::to($event->mail_data['email'])->send(new EmployeeNewRequest($event->mail_data));

    }
}
