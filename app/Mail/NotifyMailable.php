<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifyMailable extends Mailable 
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    
    public $blog; 
    public $url;

    public function __construct($blog)
    {
        $this->blog = $blog; 
        $this->url = 'http://127.0.0.1:8000/blog/'.$blog->id;
        // $this->url = url('blog/'.$blog->id);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.notification')
                    ->to('nichagiro@gmail.com')
                    ->from('notificaciones@angelivewire.com', 'Anonymous')
                    ->subject('Blog Actualizado');
    }
}
