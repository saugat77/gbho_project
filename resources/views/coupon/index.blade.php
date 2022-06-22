@extends('layouts.admin')

@section('content')
<div>
    <section class="content-header">
        <div class="container-fluid">
            <div class="d-flex mb-2">
                <h1>Coupons</h1>
                <div class="ml-auto">
                    <a href="{{ route('coupons.create') }}" class="btn btn-outline-primary btn-sm">Add New</a>
                </div>
            </div>
        </div>
    </section>

    @include('alerts.all')

    <x-box class="rounded">
        <table class="table table-hover table-responsive-sm">
            <tr class="text-uppercase font-poppins">
                <th>Type</th>
                <th>Code</th>
                <th>Valid From</th>
                <th>Valid Till</th>
                <th></th>
                <th></th>
            </tr>
            <tbody>
                @forelse ($coupons as $coupon)
                <tr>
                    <td>{{ ucfirst($coupon->couponable->type()) }}</td>
                    <td>{{ $coupon->code }}</td>
                    <td>{{ optional($coupon->start_date)->isoFormat('lll') }}</td>
                    <td>{{ optional($coupon->end_date)->isoFormat('lll') }}</td>
                    <td>
                        <span class="coupon-status-badge {{ $coupon->isValid() ? 'valid' : 'expired' }}">{{ $coupon->isValid() ? 'Valid' : 'Expired' }}</span>
                    </td>
                    <td>
                        <a href="{{ route('coupons.edit', $coupon) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('coupons.destroy', $coupon) }}" onsubmit="return confirm('Are you sure to delete?')" class="d-inline" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger my-0">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="42" class="text-center">No Coupons found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </x-box>
</div>
@endsection
