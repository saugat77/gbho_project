@extends('layouts.admin')

@section('content')
<div>
    <x-section-title>Product Grids</x-section-title>

    @include('alerts.success')
    <div class="row">
        <div class="col-md-4">
            <x-box>
                <h5 class="h5-responsive">New Product Grid</h5>
                <form action="{{ $productGrid->exists ? route('product-grids.update', $productGrid) : route('product-grids.store') }}" method="POST">
                    @csrf
                    @if($productGrid->exists)
                    @method('put')
                    @endif
                    <x-form.form-group>
                        <x-form.label class="required">Title</x-form.label>
                        <x-fields.input name="title" class="{{ invalid_class('title') }}" :value="old('title', $productGrid->title)" />
                    </x-form.form-group>

                    <x-form.form-group>
                        <x-form.label class="required">Category</x-form.label>
                        <select name="category_id" id="" class="custom-select {{ invalid_class('category_id') }}">
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}" @if(old('category_id', $productGrid->category_id) == $category->id) selected @endif>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <x-invalid-feedback field="category_id"></x-invalid-feedback>
                    </x-form.form-group>

                    <x-form.form-group>
                        <x-form.label class="required">Number of products</x-form.label>
                        <x-fields.input name="number_of_products" class="{{ invalid_class('number_of_products') }}" :value="old('number_of_products', $productGrid->number_of_products)" />
                    </x-form.form-group>

                    @if($productGrid->exists)
                    <x-form.form-group>
                        <x-form.label class="required">Active</x-form.label>
                        <select name="active" id="" class="custom-select">
                            <option value="1" @if($productGrid->active) selected @endif>Active</option>
                            <option value="0" @if(!$productGrid->active) selected @endif>Inactive</option>
                        </select>
                    </x-form.form-group>
                    @endif

                    <x-form.form-group>
                        <button type="submit" class="btn btn-primary text-capitalize px-5">{{ $productGrid->exists ? 'Update' : 'Add' }}</button>
                    </x-form.form-group>
                </form>
            </x-box>
        </div>
        <div class="col-md-8">
            <x-box>
                <div id="sortable-category-menu">
                    @foreach($productGrids as $productGrid)
                    <div class="d-flex align-items-center border p-2 @if(!$productGrid->active) grey lighten-5 @endif" data-id="{{ $productGrid->id}}" data-order="{{ $productGrid->position ?? 0 }}">
                        <div class="sort-handle p-2"><span class="mr-3"><i class="fas fa-arrows-alt fa-lg"></i></span></div>
                        <div class="w-100">
                            <h5 class="h5-responsive">{{ $productGrid->title }}</h5>
                            <div class="d-flex justify-content-between">
                                <div class="text-muted">No. of products: {{ $productGrid->number_of_products }}</div>
                                <div class="text-muted">Category: {{ $productGrid->category->name }}</div>
                                <div class="{{ $productGrid->active ? 'text-success' : 'text-danger' }}">{{ $productGrid->active ? 'Active' : 'Inactive' }}</div>
                                <a class="text-primary" href="{{ route('product-grids.edit', $productGrid) }}">Edit</a>

                                <form action="{{ route('product-grids.destroy', $productGrid) }}" method="post" onsubmit="return confirm('Are you sure to delete?');" class="form-inline d-inline">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="py-0 px-2 m-0 text-danger bg-transparent border-0">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <button id="update-position-btn" type="button" class="btn btn-primary mx-0 mt-3 text-capitalize">Update position</button>
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
