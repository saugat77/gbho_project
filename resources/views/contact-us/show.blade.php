@extends('layouts.admin')

@section('content')
<div>
    <section class="content-header">
        <div class="container-fluid">
            <div class="d-flex mb-2">
                <h1>Contact Form Submissions</h1>
            </div>
        </div>
    </section>

    @include('alerts.all')

    <x-box class="rounded">
        <div>
            <p>From: {{ $contactUs->name }}</p>
            <p>Email: {{ $contactUs->email }}</p>
            <p>Mobile: {{ $contactUs->mobile }}</p>
        </div>
        <div>
            <div>Message:</div>
            <div>
                {!! $contactUs->message !!}
            </div>
        </div>
    </x-box>
</div>
@endsection
