<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMailable extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public  $data;


    public function __construct($datos)
    {
        $this->data = $datos;
    
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.email')
        ->to('nichagiro@gmail.com')
        ->from($this->data['email'], $this->data['name'])
        ->subject($this->data['subject']);
        
    }
}

    
