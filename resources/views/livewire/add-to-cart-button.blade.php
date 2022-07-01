<div class="flex items-center justify-center space-x-1 md:space-x-2 text-sm">
    @if ($withQuantity)
    <input wire:model="quantity" type="number" class="bg-gray-100 border py-2 px-3" style="width: 70px;" min="1" max="{{ $product->stock_quantity ?? '' }}">
    @endif
    <button wire:click="addToCart" class="flex-grow text-white py-2 px-2 md:px-4 my-3 hover:bg-dark hover:shadow-lg focus:shadow-outline rounded-sm @if($small) bg-primary text-xs @elseif($buyNow) bg-sec-600 @else bg-primary text-sm @endif">
        <span class="flex items-center justify-center">
            <span wire:loading wire:target="addToCart">
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </span>
            <span class="mr-2">
                <svg class="h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </span>
            <span class="font-nunito tracking-wide {{ $small ? '' : 'uppercase' }}">
                {{ $buyNow ? 'Buy Now' : 'Add to cart' }}
            </span>
        </span>
    </button>
</div>
