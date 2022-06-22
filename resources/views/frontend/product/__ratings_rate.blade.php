<div class="flex flex-col sm:flex-row items-center space-x-2">
    <div class="my-1">
        <x-rating-stars :stars="count($product->ratings)" />
    </div>
    @if(Auth::check() && !Auth::user()->hasPurchased($product))
    <div x-data="{ open: false }" @open-review-modal.window="open = true" @close-review-modal.window="open = false">
        <button type="button" class="text-sm text-white sm:text-dark hover:underline" @click="$dispatch('open-review-modal')">Write a review</button>
        {{-- Review Modal --}}
        <div x-show="open" class="mt-6" x-cloak>
            <div class="fixed top-0 left-0 flex items-center justify-center w-full h-full z-50" style="background-color: rgba(0,0,0,.5);">
                <div class="w-full max-w-screen-sm md:p-6">
                    <div class="bg-white min-h-screen sm:min-h-0 sm:rounded shadow mx-0 md:mx-10" @click.away="open = false">
                        <livewire:product-review :product="$product" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
