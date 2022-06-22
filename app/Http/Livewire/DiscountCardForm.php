<?php

namespace App\Http\Livewire;

use App\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DiscountCardForm extends Component
{
    public $user;
    public $applicationSubmitted;
    public $application = [
        'name',
        'email',
        'mobile',
        'city',
        'address_line_one',
        'address_line_two',
        'period',
        'card_type',
        'agreement'
    ];

    protected $rules = [
        'application.name' => 'required',
        'application.email' => 'required',
        'application.mobile' => 'required',
        'application.city' => 'required',
        'application.address_line_one' => 'required',
        'application.address_line_two' => 'nullable',
        'application.period' => 'required',
        'application.card_type' => 'required',
        'application.agreement' => 'required',
    ];

    protected $messages = [
        'application.name.required' => 'Applicant\'s name is required.',
        'application.email.required' => 'Applicant\'s email is required.',
        'application.mobile.required' => 'Applicant\'s mobile number is required.',
        'application.city.required' => 'The city field is required.',
        'application.address_line_one.required' => 'The address line one field is required.',
        'application.address_line_two.required' => 'The address line two field is required.',
        'application.period.required' => 'The card period is required.',
        'application.card_type.required' => 'The card type is required',
        'application.agreement.required' => 'You must agree to our terms & privacy policy.',
    ];

    public function mount()
    {
        $this->user = Auth::check() ? Auth::user() : new User();
        $this->application['name'] = $this->user->name;
        $this->application['email'] = $this->user->email;
        $this->application['mobile'] = $this->user->mobile;
        $this->application['period'] = 1;
    }

    public function submit()
    {
        $validatedData = $this->validate();
        unset($this->application);
        $this->applicationSubmitted = true;
    }

    public function render()
    {

        return view('livewire.discount-card-form', [
            'user' => $this->user
        ]);
    }
}
