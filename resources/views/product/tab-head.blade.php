<ul id="product-tab" class="nav nav-tabs mb-3">
    @if($updateMode)
    <li class="nav-item">
        <a class="nav-link @if($activeTab == 'general') active @endif" href="{{ route('products.edit', $product) }}">General</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if($activeTab == 'images') active @endif" href="{{ route('products.images', $product) }}">Images</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if($activeTab == 'seo') active @endif" href="{{ route('products.seo', $product) }}">SEO</a>
    </li>
    @else
    <li class="nav-item">
        <a class="nav-link active" href="#">General</a>
    </li>
    @endif
</ul>

@push('styles')
<style>
    #product-tab .nav-link {
        color: #3c4961;
    }
    #product-tab.nav-tabs,
    #product-tab.nav-tabs .nav-link.active
    {
        border-color: #6610f2;
    }
</style>
@endpush
