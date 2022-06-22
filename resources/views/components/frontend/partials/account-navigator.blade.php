<div class="bg-gradient-to-r from-red-500 to-red-600 400">
    <div class="flex space-x-3 items-center py-2 px-3 border-b border-dashed border-white">
        <a class="text-white" href="{{ route('frontend.user.account.index') }}">
            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </a>
        <h1 class="text-white leading-7 tracking-wide">{{ $heading }}</h1>
    </div>
    <div class="text-white text-sm tracking-wider py-2 px-4">
        Hello, {{ $user->name }}
    </div>
</div>
