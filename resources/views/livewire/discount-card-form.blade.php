<form wire:submit.prevent="submit">
    <div class="max-w-screen-md mx-auto">
        <div class="bg-white rounded p-4">
            <h4 class="text-2xl text-blue-900 font-nunito leading-8 tracking-wide mb-4">Application for Discount Card</h4>

            @if(!Auth::check())
            <div class="font-nunito bg-red-100 text-red-600 py-2 px-3 border border-red-200 rounded my-4">
                You must have created an account with us before you can request for Discount Card. If you already have an account proceed to <a class="text-blue-500 underline" href="{{ route('login') }}">Login</a> or else create an account <a class="text-blue-500 underline" href="{{ route('register') }}">here</a>.
            </div>
            @endif

            <div class="flex flex-wrap -mx-2 -mb-4">

                <div class="w-full md:w-1/2 px-2 mb-4">
                    <x-form.tailwind-label class="required">Name</x-form.tailwind-label>
                    <input wire:model="application.name" class="form-input w-full {{ invalid_class('application.name', 'tailwind') }}">
                    <x-tailwind-invalid-feedback field="application.name"></x-tailwind-invalid-feedback>
                </div>

                <div class="w-full md:w-1/2 px-2 mb-4">
                    <x-form.tailwind-label class="required">Email</x-form.tailwind-label>
                    <input wire:model="application.email" class="form-input w-full w-full {{ invalid_class('application.email', 'tailwind') }}">
                    <x-tailwind-invalid-feedback field="application.email"></x-tailwind-invalid-feedback>
                </div>

                <div class="w-full md:w-1/2 px-2 mb-4">
                    <x-form.tailwind-label>Mobile</x-form.tailwind-label>
                    <input wire:model="application.mobile" class="form-input w-full {{ invalid_class('application.mobile', 'tailwind') }}">
                    <x-tailwind-invalid-feedback field="application.mobile"></x-tailwind-invalid-feedback>
                </div>

                <div class="w-full md:w-1/2 px-2 mb-4">
                    <x-form.tailwind-label>City</x-form.tailwind-label>
                    <input wire:model="application.city" class="form-input w-full {{ invalid_class('application.city', 'tailwind') }}">
                    <x-tailwind-invalid-feedback field="application.city"></x-tailwind-invalid-feedback>
                </div>

                <div class="w-full md:w-1/2 px-2 mb-4">
                    <x-form.tailwind-label class="required">Address line one</x-form.tailwind-label>
                    <input wire:model="application.address_line_one" class="form-input w-full {{ invalid_class('application.address_line_one', 'tailwind') }}">
                    <x-tailwind-invalid-feedback field="application.address_line_one"></x-tailwind-invalid-feedback>
                </div>

                <div class="w-full md:w-1/2 px-2 mb-4">
                    <x-form.tailwind-label>Address line two</x-form.tailwind-label>
                    <input wire:model="application.address_line_two" class="form-input w-full {{ invalid_class('application.address_line_two', 'tailwind') }}">
                    <x-tailwind-invalid-feedback field="application.address_line_two"></x-tailwind-invalid-feedback>
                </div>

                <div class="w-full md:w-1/2 px-2 mb-4">
                    <x-form.tailwind-label>Period</x-form.tailwind-label>
                    <select wire:model="application.period" class="form-select mt-1 block w-full">
                        <option value=1">1 year</option>
                        <option value="2">2 year</option>
                        <option value="3">3 year</option>
                        <option value="4">4 year</option>
                    </select>
                    <x-tailwind-invalid-feedback field="application.period"></x-tailwind-invalid-feedback>
                </div>

                <div class="w-full px-2 mb-4">
                    <x-form.tailwind-label>Card Type</x-form.tailwind-label>
                    <div class="mt-2">
                        <div>
                            <label class="inline-flex items-center">
                                <input wire:model="application.card_type" type="radio" class="form-radio text-indigo-600" value="1">
                                <span class="ml-2">Silver (5% off)</span>
                            </label>
                        </div>
                        <div>
                            <label class="inline-flex items-center">
                                <input wire:model="application.card_type" type="radio" class="form-radio text-green-500" value="2">
                                <span class="ml-2">Gold (10% off)</span>
                            </label>
                        </div>
                        <div>
                            <label class="inline-flex items-center">
                                <input wire:model="application.card_type" type="radio" class="form-radio text-pink-600" value="3">
                                <span class="ml-2">Platinum (15% off)</span>
                            </label>
                        </div>
                        <x-tailwind-invalid-feedback field="application.card_type"></x-tailwind-invalid-feedback>
                    </div>
                </div>

                <div class="w-full px-2 mb-4">
                    <label class="inline-flex items-center">
                        <input wire:model="application.agreement" type="checkbox" class="form-checkbox">
                        <span class="ml-2">I agree to the Discount Box <a class="text-blue-600 hover:underline" href="#" target="_blank">Terms & conditions</a> & <a class="text-blue-600 hover:underline" href="#" target="_blank">Privacy Policy</a>.</span>
                    </label>
                    <x-tailwind-invalid-feedback field="application.agreement"></x-tailwind-invalid-feedback>
                </div>

                @if($applicationSubmitted)
                <div class="p-3">
                    <div class="font-nunito bg-green-100 text-green-600 py-2 px-3 border border-green-200 rounded">
                        Your application has been submitted. You will get back to you as early as possible. Thank you for being with us.
                    </div>
                </div>
                @endif

                <div class="w-full p-3">
                    <button type="submit" class="bg-gray-800 hover:bg-gray-900 text-white hover:shadow focus:shadow-outline py-3 px-5 rounded @if(!Auth::check()) opacity-50 cursor-not-allowed @endif" @if(!Auth::check()) disabled @endif wire:loading.attr="disabled" wire:loading.class="opacity-50 cursor-not-allowed" wire:target='"submit"'>
                        <span wire:loading wire:target="submit">
                            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </span>
                        Request now
                    </button>
                </div>
            </div>
            {{-- End of form flex row --}}
        </div>
    </div>
    </div>
</form>
