<?php

namespace App\Listeners;

use App\Events\WishGrantedMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendGrantedMail implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  WishGrantedMail  $event
     * @return void
     */
    public function handle(WishGrantedMail $event)
    {
         //creates a mailable instance
         Mail::to($event->mail_data['email'])->send(new \App\Mail\WishGrantedMail($event->mail_data));
    }
}
