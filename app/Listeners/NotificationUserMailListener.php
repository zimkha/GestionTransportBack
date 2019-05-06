<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Client;
use Mail;
class NotificationUserMailListener
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
        $client = Client::find($event->userId)->toArray();
                    // Envoi le message mail via un Callback
                Mail::send('emails.mailEvent', $client, function($message) use ($client) {

                $message->to($client['email']);

                $message->subject('Votre commande a été bien prise en charge');

        });

    }
}
