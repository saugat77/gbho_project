<div class="fixed top-0 left-0 flex items-center justify-center w-full h-full z-50" style="background-color: rgba(0,0,0,.5);" x-show="open" x-cloak>

    <div class="h-auto p-4 mx-2 text-left bg-white rounded shadow-xl md:w-full md:max-w-xl md:p-6 lg:p-8 md:mx-0" @click.away="open = false">

        <div class="flex mb-4">
            <div class="ml-auto">
                Already have account? <a class="text-purple-600 hover:underline focus:underline" href="{{ route('login') }}">Login</a>
            </div>
        </div>
     
        @include('auth.register-form')

    </div>
</div>
