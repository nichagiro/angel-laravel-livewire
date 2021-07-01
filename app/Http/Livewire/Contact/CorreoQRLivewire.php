<?php

namespace App\Http\Livewire\Contact;

use App\Mail\ContactMailable;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class CorreoQRLivewire extends Component
{
    public $name;
    public $subject;
    public $phone;
    public $email;
    public $msg;

    protected $rules = [
        'name' => 'required|min:6',
        'subject' => 'required|min:4',
        'phone' => 'required|numeric',
        'email' => 'required|email',
        'msg' => 'required|min:10',
    ];

    protected $messages = [
        'msg.min' => 'el mensaje esta muy corto, enserio quieres mandar el correo',
    ];

    protected $validationAttributes = [
        'name' => 'Nombre'
    ];

    public function render()
    {
        return view('livewire.contact.correo-q-r-livewire');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    public function sendEmail(){

        $this->validate();

        $datos = [
            "name" => $this->name,
            "subject" => $this->subject,
            "phone" => $this->phone,
            "email" => $this->email,
            "msg" => $this->msg
        ];

        try {

            Mail::queue(new ContactMailable($datos));

            session()->flash('status', true);
            session()->flash('msg', 'Correo enviado');
            session()->flash('bg', 'green');

            $this->reset();
            
        } catch (\Throwable $th) {
            
            session()->flash('status', true);
            session()->flash('msg', 'El correo no se pudo enviar');
            session()->flash('bg', 'red');

        }
     

    }
}
