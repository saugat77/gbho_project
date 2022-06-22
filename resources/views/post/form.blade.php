@extends('layouts.admin')

@section('content')
<div>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 d-flex">
                    <h1 class="d-inline-block">{{ isset($post) ? 'Update' : 'New' }} Post</h1>
                    @isset($product)
                    <a class="btn btn-outline-primary btn-sm z-depth-0 align-self-center my-0 ml-3 py-1" href="{{ route('backend.posts.create') }}">Add New</a>
                    @endisset
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('posts.index') }}">Posts</a></li>
                        <li class="breadcrumb-item active">{{ isset($Post) ? 'Update' : 'New' }} Post</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <div class="row">
        {{-- Alerts --}}
        <div class="col-md-6">
            @include('alerts.all')
        </div>
    </div>
    
    <div>
        <x-post-form :post="$post ?? null" />
    </div>
</div>
@endsection