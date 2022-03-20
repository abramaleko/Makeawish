<?php

namespace App\Listeners;

use App\Events\DeclineMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendDeclinedMail 
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
     * @param  DeclineMail  $event
     * @return void
     */
    public function handle(DeclineMail $event)
    {
         //creates a mailable instance
         Mail::to($event->mail_data['email'])->send(new \App\Mail\DeclineMail($event->mail_data));
    }
}
