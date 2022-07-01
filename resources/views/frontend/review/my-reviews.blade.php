@extends('layouts.app')

@section('content')
<x-frontend.account-layout>
    <x-slot name="mobileHeading">
        <x-frontend.partials.account-navigator :heading="$heading" />
    </x-slot>

    <x-slot name="heading">
        <h4 class="text-xl text-gray-800 leading-relaxed tracking-wide font-medium mb-3 font-poppins">{{ $heading }}</h4>
    </x-slot>

    <div class="bg-white rounded p-2 md:p-6">
        @include('partials.alerts')

        @foreach($reviews as $review)
        <div class="font-nunito mb-5 bg-gray-100 bg-opacity-50 border border-gray-200 p-4 rounded">
            <div class="flex gap-4 md:gap-5">
                <div>
                    <div class="mb-2">
                        <x-rating-stars :stars="$review->rating" />
                    </div>
                    <div class="text-sm">on <span class="font-semibold">{{ optional($review->product)->name }}</span> at <span class="font-semibold">{{ $review->created_at->isoFormat('D MMMM YYYY') }}</span></div>
                    <p class="font-bold my-2">{{ $review->headline }}</p>
                    <p class="leading-5 text-gray-700">
                        {{ $review->description }}
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Placeat a nihil natus fuga consequuntur corrupti repudiandae nostrum est voluptatem libero et praesentium mollitia earum ut impedit sapiente sit, aperiam illo dolorum. Aut, praesentium, id facilis dolores impedit eveniet reiciendis sapiente velit quae autem reprehenderit possimus commodi corporis molestiae laudantium quod.
                    </p>
                </div>
            </div>
        </div>
        @endforeach

    </div>
</x-frontend.account-layout>
@endsection
