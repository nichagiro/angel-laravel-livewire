<?php

namespace App\Listeners;

use App\Events\NotificationBlogEvent;
use App\Models\blog_delete;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

class StoreBlogListener
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

            blog_delete::create([
                "title" =>  $event->blog->title,
                "autor" =>  Auth::user()->name,
                "cuerpo" => $event->blog->body
            ]);
            
        } catch (\Throwable $th) {

            // dd($th);
            session()->flash('notify', true);
            session()->flash('msg1', 'No se guardo el historial del blog');
            session()->flash('bg1', 'red');

        }
    }
}
