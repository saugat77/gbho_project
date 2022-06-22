@extends('layouts.app')

@if($page->show_breadcrumbs)
@section('breadcrumbs', Breadcrumbs::render('page', $page->title ?? null))
@endif

@section('content')
@if($page->hasFeaturedImage())
<img class="w-full h-auto mx-auto" src="{{ $page->featured_image_url }}" alt="{{ $page->title }}">
@endif
<div class="px-8 py-5">
    <div class="container mx-auto">
        @if($page->show_title)
        <h1 class="text-4xl font-semibold text-gray-800 leaing-8 tracking-wide">{{ $page->title }}</h1>
        @endif
        <div>
            {!! $page->content !!}
        </div>
    </div>
</div>
@endsection
