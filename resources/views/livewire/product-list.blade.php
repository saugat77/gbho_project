<div class="row">
    <div class="col-md-12">
        <x-box class="mb-4">
            <form wire:submit.prevent="search" class="form-inline">
                <div class="form-row align-items-center">
                    <div class="col-auto form-group">
                        <input wire:model.defer="filter.name" type="text" class="form-control" placeholder="Product name">
                    </div>
                    <div class="col-auto form-group ">
                        <select wire:model.defer="filter.category_id" class="custom-select">
                            <option value="all">All Categories</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-auto form-group ">
                        <select wire:model.defer="filter.status" class="custom-select">
                            <option value="all">All</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </form>
        </x-box>
    </div>
    <div class="col-md-12">
        <x-box class="rounded">
            <div class="mb-3">
                <select wire:model="paginate" class="custom-select w-auto">
                    <option value="15">15</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="10">100</option>
                </select>
                <span class="ml-2">records per page</span>
            </div>
            <table class="table table-responsive-sm">
                <tr class="text-uppercase font-poppins">
                    <th>Name</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th class="text-center">Stock</th>
                    <td class="text-center">Is Top?</td>
                    <th class="text-center">Status</th>
                    <th></th>
                </tr>
                <tbody>
                    @forelse($products as $product)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                @if($product->featuredImage)
                                <img class="border rounded-sm" src="{{ $product->small_featured_image_url }}" style="height: 3em; width: 3em; padding: 2px;">
                                @endif
                                <div class="ml-3">
                                    <a class="btn-link" href="{{ route('frontend.products.show', $product) }}" target="_blank">{{ $product->name }}</a>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div>{{ priceUnit() }} {{ number_format($product->current_price) }}</div>
                            @if ($product->hasDiscount())
                            <div style="text-decoration: line-through; font-size: .9rem;">
                                {{ priceUnit() }} {{ number_format($product->regular_price) }}
                            </div>
                            @endif
                        </td>
                        <td><span class="badge badge-light">{{ $product->category->name }}</span></td>
                        <td class="font-weight-bolder text-center">
                            @if($product->manage_stock)
                            <span class="{{ $product->stock_quantity ? 'text-success' : 'text-danger' }}">
                                {{ $product->stock_quantity ? 'In stock' : 'Out of stock' }}
                            </span>
                            @else
                            --
                            @endif
                        </td>
                        <td class="text-center">
                            <livewire:top-product-switch :product="$product" :key="$product->id" />
                        </td>
                        <td class="text-center">
                            <livewire:product-status-switch :product="$product" :key="$product->id" />
                        </td>
                        <td class="text-right">
                            <div>
                                <a type="button" class="text-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="svg-icon svg-baseline">
                                        @include('svg.verticle-dots')
                                    </span>
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('products.edit', $product) }}">Edit</a>
                                    <form action="{{ route('products.destroy', $product) }}" onsubmit="return confirm('Are you sure to delete?')" method="POST" class="form-inline d-inline">
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
                        <td colspan="42" class="text-center font-italic text-danger">No Record Exists</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="d-flex justify-content-between py-3">
                <div class="mb-3 text-muted">
                    Showing records {{ $products->firstItem() }} - {{ $products->lastItem() }} of {{ $products->total() }}
                </div>
                {{ $products->links() }}
            </div>
        </x-box>
    </div>
</div>
