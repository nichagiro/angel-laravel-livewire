<?php

namespace App\Listeners;

use App\Events\NotificationBlogEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Vonage\Client\Credentials\Basic;
use Vonage\Client;
use Vonage\SMS\Message\SMS;

class smsListener implements ShouldQueue
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
     * @param  NotificationBlogEvent  $event
     * @return void
     */
    public function handle(NotificationBlogEvent $event)
    {

        try {

            $basic  = new Basic(env('NEXMO_KEY'), env('NEXMO_SECRET')); 
            $client = new Client($basic);

        
            $response = $client->sms()->send(
                new SMS("573184015986", 'Notificaciones', 
                        'El blog '.$event->blog->title.' Ha sido Actualizado')
            );

            $message = $response->current();

            if ($message->getStatus() != 0) {
                session()->flash('status', true);
                session()->flash('msg', 'No se pudo enviar la notificacion por SMS');
                session()->flash('bg', 'red');
            } 
            
        } catch (\Throwable $th) {
            session()->flash('notify', true);
            session()->flash('msg1', 'No se pudo enviar la notificacion por SMS');
            session()->flash('bg1', 'red');
        }
        
    }
}
