<div class="relative mx-auto w-full sm:w-5/12 md:w-7/12">
    <form action="{{ route('frontend.products.index') }}" method="GET" class="flex">
        @csrf
        <div id="header-search" class="flex w-full text-sm">
            <button type="button" class="sm:hidden r-0 h-full bg-dark text-white px-3 hover:bg-secondary border border-dark hover:border-secondary">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </button>
            <input wire:model="query" type="text" name="pname" class="w-full border-2 border-r-0 border-dark font-nunito py-1 md:py-3 px-4 text-gray-700 placeholder-gray-600 tracking-wide" placeholder="I'm looking for..." autocomplete="off">
            <button type="submit" class="block r-0 h-full bg-dark text-white px-3 hover:bg-primary border border-dark hover:border-dark">
                <svg class="h-5 w-5 md:h-6 md:w-6 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path d="M0 0h24v24H0z" fill="none" />
                    <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" />
                </svg>
            </button>
        </div>
    </form>
    @if(count($products))
    <div x-show="show" class="absolute left-0 right-0 bg-white py-1 shadow-xs z-40 font-nunito mt-1" x-data="{ show: true}"" @click.away=" show=false">
        <ul class="text-gray-700">
            @foreach($products as $product)
            <li>
                <a class="flex items-center space-x-2 hover:bg-primary hover:text-white -400 p-2" href="{{ route('frontend.products.index', ['pname' => $product->name]) }}">
                    {{-- <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M0 0h24v24H0z" fill="none" />
                        <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" />
                    </svg> --}}
                    <span>
                        <img class="h-10 w-10" src="{{ $product->small_featured_image_url }}" alt="{{ $product->name }}">
                    </span>
                    <span>
                        {{ $product->name }}
                    </span>
                </a>
            </li>
            @endforeach
        </ul>
    </div>
    @endif
</div>
