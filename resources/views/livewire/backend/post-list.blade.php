<div class="row">
    <div class="col-md-12">
        <x-box class="mb-4 border-0 rounded shadow-sm">
            <form wire:submit.prevent="search" class="form">
                <div class="form-row align-items-center">
                    <div class="col-auto form-group">
                        <label for="">Title</label>
                        <input wire:model.defer="filter.title" type="text" class="form-control" placeholder="Post title">
                    </div>
                    <div class="col-auto form-group ">
                        <label for="">Status</label>
                        <select wire:model.defer="filter.status" class="custom-select">
                            <option value="all">All</option>
                            <option value="published">Published</option>
                            <option value="draft">Draft</option>
                        </select>
                    </div>
                    <div class="col-auto form-group ">
                        <label>Trashed</label>
                        <select wire:model.defer="filter.trashed" class="custom-select">
                            <option value="">No</option>
                            <option value="1">Yes</option>
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
        <x-box class="border-0 rounded shadow-sm">
            <div class="mb-3">
                <select wire:model="paginate" class="custom-select w-auto">
                    <option value="15">15</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select> records per page
            </div>
            <table class="table">
                <tr class="bg-light">
                    <td>Title</td>
                    <td>Status</td>
                    <td class="text-center">Views</td>
                    <td></td>
                </tr>
                <tbody>
                    @forelse($posts as $post)
                    <tr>
                        <td>
                            <a class="" href="{{ route('posts.edit', $post) }}">{{ $post->title }}</a>
                            <div>
                                @if ($post->trashed())
                                <div class="badge badge-danger">
                                    Trashed
                                </div>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="badge {{ $post->isPublished() ? 'badge-success' : 'badge-danger' }} shadow-none">
                                {{ $post->isPublished() ? 'Published' : 'Draft' }}
                            </div>
                        </td>
                        <td class="text-center">{{ $post->views }}</td>
                        <td class="text-right">
                            <div>
                                <a type="button" class="text-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="svg-icon svg-baseline">
                                        @include('svg.verticle-dots')
                                    </span>
                                </a>
                                <div class="dropdown-menu">
                                    @if(Route::has('posts.show'))
                                    <a class="dropdown-item" href="{{ route('posts.show', $post) }}" target="_blank">View</a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('posts.edit', $post) }}">Edit</a>
                                    @if($post->trashed())
                                    <form action="{{ route('posts.restore', $post) }}" method="POST" class="form-inline d-inline">
                                        @csrf
                                        @method('patch')
                                        <button class="dropdown-item" type="submit">Restore</button>
                                    </form>
                                    <form action="{{ route('posts.forceDelete', $post) }}" onsubmit="return confirm('This will permanantly delete post. Are you sure to delete?')" method="POST" class="form-inline d-inline">
                                        @csrf
                                        @method('delete')
                                        <button class="dropdown-item" type="submit">Delete</button>
                                    </form>
                                    @else
                                    <form action="{{ route('posts.destroy', $post) }}" onsubmit="return confirm('Are you sure to delete?')" method="POST" class="form-inline d-inline">
                                        @csrf
                                        @method('delete')
                                        <button class="dropdown-item" type="submit">Trash</button>
                                    </form>
                                    @endif
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
                    Showing records {{ $posts->firstItem() }} - {{ $posts->lastItem() }} of {{ $posts->total() }}
                </div>
                {{ $posts->links() }}
            </div>
        </x-box>
    </div>
</div>
