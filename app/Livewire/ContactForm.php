<?php

namespace App\Livewire;

use Livewire\Component;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Mail;

class ContactForm extends Component
{
    public $name = '';
    public $email = '';
    public $message = '';
    public $showModal = false;

    protected $rules = [
        'name' => 'required|min:2',
        'email' => 'required|email',
        'message' => 'required|min:10',
    ];

    public function submit()
    {
        $validatedData = $this->validate();

        // Trimite email
        Mail::to('ioanclickmihalca@gmail.com')->send(new ContactFormMail($validatedData));

        // Reset form și închide modal
        $this->reset(['name', 'email', 'message']);
        $this->showModal = false;
        
        // Notificare de succes
        session()->flash('message', 'Message sent successfully!');
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}