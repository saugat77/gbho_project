@if(count($products))
<div class="container mx-auto py-5 px-2 sm:px-4 md:px-0">
    <div class="mb-4">
        @isset($title)
        <div class="title-block py-1 md:py-2 border-b my-2 md:my-3">
            <h2 class="text-base md:text-lg lg:text-2xl font-bold m-0">{{ $title }}</h2>
        </div>
        @endisset
        <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
            @foreach ($products as $product)
                <livewire:product-card :product="$product">
            @endforeach
        </div>
    </div>
</div>
@endif
