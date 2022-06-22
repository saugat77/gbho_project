<div class="px-5 py-8 text-dark">
    <div class="flex space-x-3 mb-4">
        <img class="h-16 w-20 object-cover rounded" src="{{ $product->small_featured_image_url }}" alt="{{ $product->name }}">
        <h1 class="text-lg">{{ $product->name }}</h1>
    </div>

    <form wire:submit.prevent="save" class="font-sans">

        <div class="my-3">
            <label for="" class="block mb-1 font-medium text-sm">Rate this item</label>
            <select wire:model="productRating.rating" class="form-select w-full @error('rating')  border-red-500 @enderror">
                <option value="5">5</option>
                <option value="4">4</option>
                <option value="3">3</option>
                <option value="2">2</option>
                <option value="1">1</option>
            </select>
            <x-tailwind-invalid-feedback field="productRating.rating"></x-tailwind-invalid-feedback>
        </div>

        <h3 class="block mt-6 text-lg font-medium">Write a review</h3>

        <div class="my-2">
            <label for="" class="block mb-1 font-medium text-sm">Give it a headline</label>
            <input wire:model="productRating.headline" class="form-input w-full @error('productRating.headline')  border-red-500 @enderror">
            <x-tailwind-invalid-feedback field="productRating.headline"></x-tailwind-invalid-feedback>
        </div>

        <div class="my-3" x-data="{ count: 0 }" x-init="count = $refs.description.value.length">
            <label for="" class="block mb-1 font-medium text-sm">Tell us what you like & what you don't</label>
            <textarea wire:model="productRating.description" class="form-textarea block w-full @error('productRating.description')  border-red-500 @enderror" rows="5" x-ref="description" x-on:keyup="count = $refs.description.value.length"></textarea>
            <small class="text-xs"><span x-text="count"></span>/100</small>
            <x-tailwind-invalid-feedback field="productRating.description"></x-tailwind-invalid-feedback>
        </div>

        <div class="my-3 flex -mx-2">
            <div class="w-full md:w-1/2 px-2">
                <button type="submit" class="w-full py-2 px-3 text-gray-100 font-medium border-2 border-primary bg-primary rounded hover:shadow-lg hover:bg-white hover:text-main-600 focus:outline-none focus:shadow-outline" wire:target="save" wire:loading.attr="disabled">
                    <span class="flex items-center justify-center">
                        <x-loading-spinner wire:loading wire:target="save"></x-loading-spinner>
                        <span>Submit</span>
                    </span>
                </button>
            </div>
            <div class="w-full md:w-1/2 px-2">
                <button type="reset" @click="$dispatch('close-review-modal')" class="w-full py-2 px-3 text-gray-100 font-medium border-2 border-gray-900 bg-gray-900 rounded hover:shadow-lg hover:bg-white hover:text-gray-900 focus:outline-none focus:shadow-outline">Cancel</button>
            </div>
        </div>
    </form>

</div>
