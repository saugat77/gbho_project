@extends('layouts.admin')

@section('content')
<div>
    <x-section-title>Product Groups</x-section-title>
    <x-box class="rounded" style="max-width: 600px; margin-left: 0; margin-right: 0;">
        <form action="{{ route('product-group.store') }}" method="POST">
            @csrf
            <x-form.form-group class="d-flex mb-0">
                {{-- <x-form.label class="required">Title</x-form.label> --}}
                <div class="flex-grow-1">
                    <x-fields.input name="title" class="{{ invalid_class('title') }}" :value="old('title', $productGrid->title ?? null)" placeholder="New item's title here" />
                </div>
                <div>
                    <button class="btn btn-primary mt-0" style="flex-shrink: 0;">Add</button>
                </div>
            </x-form.form-group>
        </form>
    </x-box>

    <div class="my-4"></div>

    <div id="sortable-product-groups" style="max-width: 600px; display: flex; flex-direction: column; gap: 1rem;">
        @for ($i = 1; $i < 10; $i++) <x-box class="rounded d-flex align-items-center" style="gap:1rem;" data-id="{{ $i }}" data-order="{{ $i ?? 0 }}">
            <div class="sort-handle" style="color: #cccccc;">
                <i class="fa fa-grip-vertical fa-lg"></i>
            </div>
            <div class="d-flex flex-grow-1">
                <div>Latest Products</div>
                <div class="ml-auto">
                    <span>Enabled &nbsp;</span>
                    <label class="switch">
                        <input type="checkbox" wire:model="active" id="dark-mode-toggler">
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
            </x-box>
            @endfor
    </div>
</div>
@endsection


@push('scripts')
<script>
    $(function() {
        // Sorting
        $('#sortable-product-groups').sortable({
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
