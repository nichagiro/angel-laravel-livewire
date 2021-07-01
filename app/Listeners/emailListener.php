<?php

namespace App\Listeners;

use App\Events\NotificationBlogEvent;
use App\Mail\NotifyMailable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class emailListener implements ShouldQueue

{
    public $tries = 2;
    
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
           Mail::queue(new NotifyMailable($event->blog));
        } catch (\Throwable $th) {
            session()->flash('status', true);
            session()->flash('msg', 'No se pudo mandar el correo de notificacion');
            session()->flash('bg', 'pink');
        }
 
    }
}
