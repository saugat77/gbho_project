<div class="break-words bg-white">
    {{-- <h4 class="inline-block text-white font-semibold text-lg py-2 px-4 bg-primary">{{ $title }}</h4> --}}
    <div class="px-2 sm:px-4 mt-2">
        {{-- ratings --}}
        <div class="grid grid-cols-12 gap-5">
            <div class="col-span-12 sm:col-span-4 flex flex-grow bg-gray-200 rounded border items-center justify-center px-4 text-center">
                @if($overallRating)
                <h1 class="text-3xl">
                    <span class="text-5xl text-indigo-600">{{ $overallRating }}</span><span class="text-gray-800">/5</span>
                </h1>
                @else
                <h1 class="text-xl text-primary">
                    Not rated yet
                </h1>
                @endif
                <div></div>
            </div>
            <div class="col-span-12 sm:col-span-8">
                <div class="tracking-wide">
                    <h2 class="text-gray-800 font-semibold mb-3">Rated by {{ $totalReviewsCount }} users</h2>
                    @foreach($starData as $key => $data)
                    <div class="flex items-center mt-1 gap-5">
                        <div class="text-primary tracking-tighter">
                            <span>
                                <span class="w-5 inline-block">{{ $key }}</span>
                                <svg class="inline w-5 h-5" fill="currentColor" stroke="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                </svg>
                            </span>
                        </div>
                        <div class="flex-grow">
                            <div class="bg-gray-300 w-full rounded-lg h-2">
                                <div class="bg-primary rounded-lg h-2" style="width: {{ $data['rated_by_percent'] }}"></div>
                            </div>
                        </div>
                        <div class=" text-gray-700">
                            <span class="text-sm">{{ $data['rated_by_percent'] }}%</span>
                        </div>
                    </div><!-- first -->
                    @endforeach
                </div>
            </div>
        </div>

        @if($totalReviewsCount)
        <hr class="my-4" />

        {{-- reviews --}}
        <div class="px-4 md:px-8">
            @foreach($reviews as $review)
            <div class="font-nunito mb-4">
                <div class="my-1">
                    <x-rating-stars :stars="$review->rating" />
                </div>
                <div class="text-sm">by <span class="font-semibold">{{ $review->user->name }}</span> on <span class="font-semibold">{{ $review->created_at->isoFormat('D MMMM YYYY') }}</span></div>
                <p class="font-bold">{{ $review->headline }}</p>
                <p class="text-sm leading-5">
                    {{ $review->description }}
                </p>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>
