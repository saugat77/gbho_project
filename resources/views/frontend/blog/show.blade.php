@extends('layouts.app')

@section('breadcrumbs')
{{ Breadcrumbs::render('single-blog', $post) }}
@endsection

@section('content')
<div class="container py-5 pt-0">
    <article>
        <h1 class="text-lg lg:text-4xl text-center">
            {{ $post->title }}
        </h1>
        <div class="text-center text-gray-900 opacity-75">
            Published on {{ $post->created_at->format('d M Y') }}
        </div>
        <div class="my-4"></div>
        @if ($post->cover_image)
        <div class="aspect-w-12 aspect-h-6 mb-4">
            <img src="{{ $post->imageUrl() }}" alt=" {{ $post->title }}">
        </div>
        @endif
        <div class="max-w-screen-lg mx-auto">
            {!! $post->content !!}
        </div>
    </article>
</div>
@endsection
