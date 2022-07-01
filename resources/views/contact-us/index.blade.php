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
        <table class="table table-hover table-responsive-sm">
            <tr class="text-uppercase font-poppins">
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Sent At</th>
                <th></th>
                <th></th>
            </tr>
            <tbody>
                @forelse ($data as $item)
                <tr class="@if ($item->read_at == null) bg-warning @endif">
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->mobile }}</td>
                    <td>{{ $item->created_at->isoFormat('lll') }}</td>
                    <td>
                        <a href="{{ route('contact-form-submissions.show', $item) }}" class="btn btn-sm btn-primary">View</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="42" class="text-center">No Coupons found</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        @if ($data->hasPages())
            <div class="d-flex justify-content-center">
                {{ $data->links('pagination::bootstrap-4') }}
            </div>
        @endif
    </x-box>
</div>
@endsection
