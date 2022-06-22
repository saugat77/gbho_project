@extends('layouts.app')

@section('content')
<div class="container mx-auto my-5">
    <h1 class="text-lg font-semibold mb-5"># {{ $title }}</h1>

    <section class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-4 sm:gap-5 md:gap-6 lg:gap-8">
        @foreach ($products as $product)
        <x-product-card :product="$product" />
        @endforeach
    </section>
</div>
@endsection
