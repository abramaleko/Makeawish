<?php

namespace App\Listeners;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderReference;
use App\Events\ReferenceMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendReferenceNumber 
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
     * @param  ReferenceMail  $event
     * @return void
     */
    public function handle(ReferenceMail $event)
    {
        //creates a mailable instance
        Mail::to($event->mail_data['email'])->send(new OrderReference($event->mail_data));
    }
}
