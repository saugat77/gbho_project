<?php

namespace App\Http\Livewire;

use App\ContactUs;
use App\Mail\ContactUsMail;
use Exception;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class ContactForm extends Component
{
    public $name;
    public $email;
    public $mobile;
    public $message;
    public $sent = false;
    public $messageSendError;

    protected $rules = [
        'name' => 'required',
        'email' => 'required|email',
        'mobile' => 'required',
        'message' => 'required'
    ];

    protected $messages = [
        'name.required' => 'Please enter you name.',
        'email.required' => 'Please enter you email.',
        'mobile.required' => 'Please enter you mobile.',
        'message.required' => 'Please enter you message.',
    ];

    public function send()
    {
        $this->messageSendError = null;
        $this->validate();

        try {
            ContactUs::create([
                'name' => ucfirst($this->name),
                'email' => $this->email,
                'mobile' => $this->mobile,
                'message' => $this->message
            ]);

            // TODO::setup receipient email in settings
            // Mail::to(settings('contact_form_recepient_email'))->send(new ContactUsMail($this->name, $this->email, $this->message));
            
            $this->sent = true;
            
            $this->reset(['name', 'email', 'mobile', 'message']);
        } catch (\Exception $ex) {
            logger('Error while submitting contact form.', ['Ex' => $ex->getMessage()]);
            $this->messageSendError = 'Error while submiting form. Plese try again.';
        }
    }
    
    public function render()
    {
        return view('livewire.contact-form');
    }
}
