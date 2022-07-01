<form wire:submit.prevent="send">
    @csrf
    <div>
        <span class="uppercase text-sm text-gray-700 font-semibold tracking-wide">Full Name *</span>
        <input type="text" wire:model="name" class="w-full border text-gray-900 mt-2 p-3 focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror" placeholder="">
        <x-tailwind-invalid-feedback field="name"></x-tailwind-invalid-feedback>
    </div>
    <div class="mt-8">
        <span class="uppercase text-sm text-gray-700 font-semibold tracking-wide">Email *</span>
        <input type="email" wire:model="email" class="w-full border text-gray-900 mt-2 p-3 focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror">
        <x-tailwind-invalid-feedback field="email"></x-tailwind-invalid-feedback>
    </div>
    <div class="mt-8">
        <span class="uppercase text-sm text-gray-700 font-semibold tracking-wide">Mobile *</span>
        <input type="text" wire:model="mobile" class="w-full border text-gray-900 mt-2 p-3 focus:outline-none focus:shadow-outline @error('mobile') border-red-500 @enderror">
        <x-tailwind-invalid-feedback field="mobile"></x-tailwind-invalid-feedback>
    </div>
    <div class="mt-8">
        <span class="uppercase text-sm text-gray-700 font-semibold tracking-wide">Message *</span>
        <textarea wire:model="message" class="w-full h-32 border text-gray-900 mt-2 p-3 focus:outline-none focus:shadow-outline @error('message') border-red-500 @enderror"></textarea>
        <x-tailwind-invalid-feedback field="message"></x-tailwind-invalid-feedback>
    </div>
    <div class="mt-8">
        @if ($sent)
        <div class="bg-green-100 rounded-lg py-5 px-6 mb-3 text-base text-green-700 inline-flex items-center w-full" role="alert">
            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check-circle" class="w-6 h-6 mr-3 fill-current" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
              <path fill="currentColor" d="M504 256c0 136.967-111.033 248-248 248S8 392.967 8 256 119.033 8 256 8s248 111.033 248 248zM227.314 387.314l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.249-16.379-6.249-22.628 0L216 308.118l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.249 16.379 6.249 22.628.001z"></path>
            </svg>
            Your message has been sent.  We will get back to you as early as possible.
          </div>
        @else
        <button class="flex items-center justify-center uppercase text-sm font-bold tracking-wide bg-indigo-500 text-gray-100 p-3 w-full focus:outline-none focus:shadow-outline hover:bg-secondary" wire:loading.attr="disabled">
            <svg wire:loading wire:target="send" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
              </svg>
            Send Message
        </button>
        @endif

        @if ($messageSendError)
        <div class="bg-red-100 rounded-lg py-5 px-6 mt-3 text-base text-red-700 inline-flex items-center w-full" role="alert">
            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="times-circle" class="w-6 h-6 mr-3 fill-current" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
              <path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm121.6 313.1c4.7 4.7 4.7 12.3 0 17L338 377.6c-4.7 4.7-12.3 4.7-17 0L256 312l-65.1 65.6c-4.7 4.7-12.3 4.7-17 0L134.4 338c-4.7-4.7-4.7-12.3 0-17l65.6-65-65.6-65.1c-4.7-4.7-4.7-12.3 0-17l39.6-39.6c4.7-4.7 12.3-4.7 17 0l65 65.7 65.1-65.6c4.7-4.7 12.3-4.7 17 0l39.6 39.6c4.7 4.7 4.7 12.3 0 17L312 256l65.6 65.1z"></path>
            </svg>
            {{ $messageSendError }}
          </div>
        @endif
    </div>
</form>