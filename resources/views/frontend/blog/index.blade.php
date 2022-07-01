@extends('layouts.app')

@section('breadcrumbs')
{{ Breadcrumbs::render('blogs') }}
@endsection

@section('content')
<div class="container py-5 pt-0">
    <section>
        <h1 class="text-lg lg:text-2xl mb-5">
            <span class="bg-yellow-400 py-2 px-8 text-black border-b-4 border-l-4 border-green-500">Blogs</span>
        </h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-4 lg:gap-8">
            @foreach ($posts as $post)
            <div class="rounded shadow overflow-hidden">
                @if ($post->cover_image)
                <a href="{{ route('frontend.blogs.show', $post) }}" class="block aspect-w-12 aspect-h-6">
                    <img src="{{ $post->imageUrl() }}" alt=" {{ $post->title }}">
                </a>
                @endif
                <div class="p-4">
                    <h6 class="text-gray-800 line-clamp-1">
                        <a href="{{ route('frontend.blogs.show', $post) }}">
                            {{ $post->title }}
                        </a>
                    </h6>
                    <p class="text-sm"> 
                        {{ $post->excerpt }}
                    </p>
                </div>
            </div>
            @endforeach
        </div>

          {{-- Pagination --}}
          @if ($posts->hasPages())
          <div class="py-4 mt-2">
              {{ $posts->links('vendor.pagination.tailwind') }}
          </div>
          @endif

    </section>
</div>
@endsection
