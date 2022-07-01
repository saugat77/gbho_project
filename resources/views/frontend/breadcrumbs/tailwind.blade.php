@unless ($breadcrumbs->isEmpty())

<style>
    #breadcrumbs {
        scrollbar-width: 1px;
    }
</style>

<div class="hidden md:block my-2">
    <nav class="container mx-auto">
        <ol id="breadcrumbs" class="p-3 bg-white flex flex-no-wrap text-black" style="font-size: .80em;">
            @foreach ($breadcrumbs as $breadcrumb)

            @if ($breadcrumb->url && !$loop->last)
            <li class="flex-shrink-0">
                <a href="{{ $breadcrumb->url }}" class="text-primary font-medium hover:text-blue-900 hover:underline focus:text-blue-900 focus:underline font-sans">
                    {{ $breadcrumb->title }}
                </a>
            </li>
            @else
            <li class="flex-shrink-0">
                {{ $breadcrumb->title }}
            </li>
            @endif

            @unless($loop->last)
            <li class="text-gray-900 px-2">
                >
            </li>
            @endif

            @endforeach
        </ol>
    </nav>
</div>

@endunless
