<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\RegisterClient;
use App\Client;
use Mail;
class RegisterClientListener
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
         $client = Client::find($event->client_id)->toArray();
         Mail::send('client.notification', $client, function($message) use ($client){
            $message->to($client['email'])->subject('Vous êtes enregistre dans notre base pour plus details contacter nous :)');
            $message->from('zimkhandiaye@gmail.com');
         });
    }
}
