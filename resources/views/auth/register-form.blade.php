<div class="mb-3">
    <h1 class="text-3xl font-bold text-gray-800 leading-8">Register Account</h1>
</div>
<form class="w-full text-gray-700" method="POST" action="{{ route('register') }}">
    @csrf

    @if(Session::has('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 text-sm p-2 rounded mb-4" role="alert">
        <span class="block sm:inline">{{ session()->get('error') }}</span>
    </div>
    @endif
     @if(Session::has('message'))
    <div class="bg-green-100 border border-green-400 text-green-700 text-sm p-2 rounded mb-4 success alert-success" role="success">
        <span class="block sm:inline">{{ session()->get('message') }}</span>
    </div>
    @endif


    {{-- Name --}}
    <div class="mb-6">
        <div class="flex items-center space-x-2 p-2 border-2 rounded {{ $errors->register->has('name') ? 'border-red-500' :'border-purple-700' }}">
            <span class="text-purple-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </span>
            <input class="w-full p-1 bg-transparent placeholder-purple-900 placeholder-opacity-75 text-sm font-medium autofill-transparent" type="text" name="userid" value="{{ old('userid') }}" placeholder="Your New User id">
            @error('userid')
            <p class="text-danger">{{$errors}}</p>
        @enderror
        </div>
       
        {{-- @if($errors->register->has('userid'))
        <p class="text-red-500 text-xs mt-2">
            {{ $errors->register->first('name') }}
        </p>
        @endif --}}
    </div>

    {{-- Email --}}
    <div class="mb-6">
        <div class="flex items-center space-x-2 p-2 border-2 rounded {{ $errors->register->has('email') ? 'border-red-500' :'border-purple-700' }}">
            <span class="text-purple-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
            </span>
            <input class="w-full p-1 bg-transparent placeholder-purple-900 placeholder-opacity-75 text-sm font-medium autofill-transparent" type="text" name="email" value="{{ old('email') }}" placeholder="your@email.com">
        </div>
        @if($errors->register->has('email'))
        <p class="text-red-500 text-xs mt-2">
            {{ $errors->register->first('email') }}
        </p>
        @endif
    </div>

    {{-- Password --}}
    <div class="mb-6">
        <div x-data="{ show: false }" class="flex items-center space-x-2 p-2 border-2 rounded {{ $errors->register->has('password') ? 'border-red-500' :'border-purple-700' }}"">
            <span class=" text-purple-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
            </svg>
            </span>
            <input :type="show ? 'text' : 'password'" class="w-full p-1 placeholder-purple-900 placeholder-opacity-75 text-sm font-medium" name="password" placeholder="Enter Password" autocomplete="new-password">
            <div class=" flex items-center text-sm leading-5" x-cloak>
                <svg x-show="show" class="h-4 w-4 text-purple-600" fill="none" @click="show = !show" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 576 512">
                    <path fill="currentColor" d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z">
                    </path>
                </svg>
                <svg x-show="!show" class="h-4 w-4 text-purple-600" fill="none" @click="show = !show" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 640 512">
                    <path fill="currentColor" d="M320 400c-75.85 0-137.25-58.71-142.9-133.11L72.2 185.82c-13.79 17.3-26.48 35.59-36.72 55.59a32.35 32.35 0 0 0 0 29.19C89.71 376.41 197.07 448 320 448c26.91 0 52.87-4 77.89-10.46L346 397.39a144.13 144.13 0 0 1-26 2.61zm313.82 58.1l-110.55-85.44a331.25 331.25 0 0 0 81.25-102.07 32.35 32.35 0 0 0 0-29.19C550.29 135.59 442.93 64 320 64a308.15 308.15 0 0 0-147.32 37.7L45.46 3.37A16 16 0 0 0 23 6.18L3.37 31.45A16 16 0 0 0 6.18 53.9l588.36 454.73a16 16 0 0 0 22.46-2.81l19.64-25.27a16 16 0 0 0-2.82-22.45zm-183.72-142l-39.3-30.38A94.75 94.75 0 0 0 416 256a94.76 94.76 0 0 0-121.31-92.21A47.65 47.65 0 0 1 304 192a46.64 46.64 0 0 1-1.54 10l-73.61-56.89A142.31 142.31 0 0 1 320 112a143.92 143.92 0 0 1 144 144c0 21.63-5.29 41.79-13.9 60.11z">
                    </path>
                </svg>
            </div>
        </div>
        @if($errors->register->has('password'))
        <p class="text-red-500 text-xs mt-2">
            {{ $errors->register->first('password') }}
        </p>
        @endif
    </div>

    {{-- Password Confirmation --}}
    <div class="mb-6">
        <div class="flex items-center space-x-2 p-2 border-2 rounded {{ $errors->register->has('password_confirmation') ? 'border-red-500' :'border-purple-700' }}"">
            <span class=" text-purple-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
            </svg>
            </span>
            <input type="password" class="w-full p-1 placeholder-purple-900 placeholder-opacity-75 text-sm font-medium" name="password_confirmation" placeholder="Password one last time">
        </div>
        @if($errors->register->has('password_confirmation'))
        <p class="text-red-500 text-xs mt-2">
            {{ $errors->register->first('password_confirmation') }}
        </p>
        @endif
    </div>

    {{-- Recaptcha --}}
    @if (settings('register_enable_captcha') == 'yes')
    <div class="flex flex-wrap mb-6">
        {!! htmlFormSnippet() !!}
        @if($errors->register->has('g-recaptcha-response'))
        <p class="text-red-500 text-xs mt-3">
            <strong>{{ $errors->register->first('g-recaptcha-response') }}</strong>
        </p>
        @endif
    </div>
    @endif

    {{-- Button --}}
    <div class="flex flex-wrap">
        <button type="submit" class="w-full sm:w-auto bg-purple-600 hover:bg-purple-700 hover:shadow-lg text-gray-100 font-semibold py-2 px-6 rounded-sm focus:outline-none focus:shadow-outline focus:bg-purple-700 tracking-wider uppercase">
            {{ __('Register') }}
        </button>
    </div>
</form>
