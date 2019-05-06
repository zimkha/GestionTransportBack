<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Client;
use Mail;
class RegisterCommandeListener
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
         
         Mail::send('commande.store', $client, function($message) use ($client){
          $message->to($client['email'])
          ->subject('Merci de votre fidélité, votre commande a été bien prise en charge. Veillez ignore ce message si vous n\'êtes pas l\'auteur de la commande')
          ->from('zimkhandiaye@gmail.com');
         });
    }
}
