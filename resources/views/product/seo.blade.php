<x-product-form-template :product="$product">
    <form action="{{ route('products.seo.store', $product) }}" method="post" class="form" enctype="multipart/form-data">
        @csrf
        <x-box class="my-3">
            <label>SEO</label>
            <div class="form-group">
                <input type="text" name="seo_title" class="form-control bg-light {{ invalid_class('seo_title') }}" placeholder="title" value="{{ old('seo_title', $product->seoTitle()) }}">
                <x-invalid-feedback field="seo_title"></x-invalid-feedback>
            </div>
            <div class="form-group">
                <textarea name="seo_description" id="seo_description" class="form-control bg-light {{ invalid_class('seo_description') }}" cols="30" rows="5" maxlength="{{ \App\Product::SEO_DESCRIPTION_LENGTH }}">{{ old('seo_description', $product->seoDescription()) }}</textarea>
                <small class="small form-help">Max {{ \App\Product::SEO_DESCRIPTION_LENGTH }} characters.</small>
                <x-invalid-feedback field="seo_description"></x-invalid-feedback>
            </div>

            <div class="form-group">
                <label>Custom JsonLd</label>
                <textarea name="custom_json_ld" id="custom_json_ld" class="form-control html-editor {{ invalid_class('custom_json_ld') }}" cols="30" rows="5">{{ old('custom_json_ld', $product->custom_json_ld) }}</textarea>
                <x-invalid-feedback field="custom_json_ld"></x-invalid-feedback>
            </div>
        </x-box>

        <div class="row mt-3">
            <div class="col-md-6">
                <button type="submit" class="btn btn-primary btn-block">Save</button>
            </div>
        </div>
    </form>
</x-product-form-template>
