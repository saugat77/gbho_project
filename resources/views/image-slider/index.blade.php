@extends('layouts.admin')

@section('content')
<div>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 d-flex">
                    <h1 class="d-inline-block">Image Sliders</h1>
                    <a class="btn btn-outline-primary btn-sm z-depth-0 align-self-center my-0 ml-3 py-1" href="{{ route('image-sliders.create') }}">Add New</a>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Image Sliders</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    @include('alerts.all')

    <div class="row">

        <div class="col-md-12">
            <x-box>
                <table class="table table-responsive-sm">
                    <thead>
                        <tr class="text-uppercase font-poppins">
                            <th></th>
                            <th>Group</th>
                            <th>Position</th>
                            <th>Title</th>
                            <th>Active</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($imageSliders as $imageSlider)
                        <tr>
                            <td>
                                <img src="{{ $imageSlider->image_url }}" style="height: 4em; width: 10em;">
                            </td>
                            <td>{{ ucfirst($imageSlider->group) }}</td>
                            <td>{{ $imageSlider->position }}</td>
                            <td>{{ $imageSlider->title }}</td>
                            <td>{{ $imageSlider->active }}</td>
                            <td class="text-right">
                                <div>
                                    <a type="button" class="text-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="svg-icon svg-baseline">
                                            @include('svg.verticle-dots')
                                        </span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="{{ route('image-sliders.edit', $imageSlider) }}">Edit</a>
                                        <form action="{{ route('image-sliders.destroy', $imageSlider) }}" onsubmit="return confirm('Are you sure to delete?')" method="POST" class="form-inline d-inline">
                                            @csrf
                                            @method('delete')
                                            <button class="dropdown-item" type="submit">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="42" class="font-italic text-center">No sliders found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </x-box>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(function() {
        // Sorting
        $('#sortable-category-menu').sortable({
            handle: '.sort-handle'
            , placeholder: 'sortable-placeholder'
            , update: function(event, ui) {
                $(this).children().each(function(index) {
                    if ($(this).attr('data-order') != (index + 1)) {
                        $(this).attr('data-order', (index + 1)).addClass('order-updated');
                    }
                });
            }
        });

        function persistUpdatedOrder() {
            var productGridItems = [];
            $('.order-updated').each(function() {
                productGridItems.push({
                    id: $(this).attr('data-id')
                    , position: $(this).attr('data-order')
                });
            });
            console.table(productGridItems);
            axios({
                method: 'put'
                , url: "{{ route('product-grids.sort') }}"
                , data: {
                    productGridItems: productGridItems
                , }
            }).then(function(response) {
                console.log(response);
                if (response.status == 200) {
                    showAlert('default', response.data.message);
                }
            });
        }

        $('#update-position-btn').click(function(e) {
            e.preventDefault();
            persistUpdatedOrder();
        });

    });

</script>
@endpush
