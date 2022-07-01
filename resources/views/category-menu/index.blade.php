@extends('layouts.admin')

@push('styles')
<style>
    .sortable-placeholder {
        border: 2px dashed #4285f4;
        height: 35px;
    }

    .sort-handle:hover {
        cursor: pointer;
    }

</style>
@endpush
@section('content')
<div>
    <x-section-title>Catalog Menu</x-section-title>

    <div class="row">
        <div class="col-md-4">
            <x-box>
                <form action="{{ route('category-menu.store') }}" method="POST">
                    @csrf
                    <x-form.form-group>
                        <x-form.label>Category</x-form.label>
                        <select name="category_id" id="" class="custom-select {{ invalid_class('category_id') }}">
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <x-invalid-feedback field="category_id"></x-invalid-feedback>
                    </x-form.form-group>
                    <x-form.form-group>
                        <x-form.label>Display Name</x-form.label>
                        <x-fields.input name="display_name" class="{{ invalid_class('display_name') }}" :value="old('display_name', $categoryMenu->display_name)" />
                        <x-invalid-feedback field="display_name"></x-invalid-feedback>
                    </x-form.form-group>
                    <x-form.form-group>
                        <button type="submit" class="btn btn-primary">Add to menu</button>
                    </x-form.form-group>
                </form>
            </x-box>
        </div>
        <div class="col-md-8">
            <x-box>
                <div id="sortable-category-menu">
                    @foreach($categoryMenus as $categoryMenu)
                    <div class="d-flex align-items-center border" data-id="{{ $categoryMenu->id}}" data-order="{{ $categoryMenu->position ?? 0 }}">
                        <div class="sort-handle p-2"><span class="mr-3"><i class="fas fa-arrows-alt fa-lg"></i></span></div>
                        <div>{{ $categoryMenu->display_name }}</div>
                        <div class="remove-menu-item ml-auto btn btn-sm btn-danger" data-id="{{ $categoryMenu->id }}">{{ __('Remove') }}</div>
                    </div>
                    @endforeach
                </div>

                <button id="update-menu-order-btn" type="button" class="btn btn-primary mx-0 mt-3">Update menu</button>
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
            var menuItems = [];
            $('.order-updated').each(function() {
                menuItems.push({
                    id: $(this).attr('data-id')
                    , position: $(this).attr('data-order')
                });
            });
            console.table(menuItems);
            axios({
                method: 'put'
                , url: "{{ route('category-menu.sort') }}"
                , data: {
                    menuItems: menuItems
                , }
            }).then(function(response) {
                console.log(response);
                if (response.status == 200) {
                    showAlert('default', response.data.message);
                }
            });
        }

        $('#update-menu-order-btn').click(function(e) {
            e.preventDefault();
            persistUpdatedOrder();
        });
    });

    $('.remove-menu-item').click(function(e) {
        e.preventDefault();
        let menuItem = $(this).parent();
        axios({
            method: 'delete'
            , url: "{{ route('category-menu.remove-item') }}"
            , data: {
                id: $(this).attr('data-id')
            , }
        }).then(function(response) {
            console.log(response);
            if (response.status == 200) {
                showAlert('default', response.data.message);
                menuItem.remove();
            }
        }).catch(function(error) {
            showAlert('danger', 'Failed to remove');
        });;
    });

</script>
@endpush
