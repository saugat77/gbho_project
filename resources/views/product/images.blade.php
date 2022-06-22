<x-product-form-template :product="$product">
    {{-- <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 d-flex">
                    <h1 class="d-inline-block">{{ isset($product) ? 'Update' : 'New' }} Product</h1>
                    @isset($product)
                    <a class="btn btn-outline-primary btn-sm z-depth-0 align-self-center my-0 ml-3 py-1" href="{{ route('products.create') }}">Add New</a>
                    @endisset
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('products.index') }}">Products</a></li>
                        <li class="breadcrumb-item active">{{ isset($product) ? 'Update' : 'New' }} Product</li>
                    </ol>
                </div>
            </div>
        </div>
    </section> --}}

    <section>
        <x-product-images-uploader :product="$product" />
    </section>
</x-product-form-template>
