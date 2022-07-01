<tr>
    {{-- <td>{{ $category->thumbnail }}</td> --}}
    <td>
        @if($level == 1) @endif
        @if($level == 2) &nbsp; - - @endif
        @if($level == 3) &nbsp; &nbsp; - - - - @endif
        {{ $category->name }}
    </td>
    <td>{{ $category->slug }}</td>
    <td>
        {{ $parentCategoryName ?? null }}
    </td>
    <td>
        <livewire:category-status-switch :category="$category" />
    </td>
    <td class="text-right">
        <div>
            <a type="button" class="text-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="svg-icon svg-baseline">
                    @include('svg.verticle-dots')
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="{{ route('categories.edit', $category) }}">Edit</a>
                <form class="form-inline d-inline" action="{{ route('categories.destroy', $category) }}" onsubmit="return confirm('Are you sure to delete ?')" method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit" class="dropdown-item">Delete</button>
                </form>
                @if($category->author)
                <div class="dropdown-item">Created by {{ $category->author->name }}</div>
                @endif
                @if($category->editor)
                <div class="dropdown-item">Updated by {{ $category->editor->name }}</div>
                @endif
            </div>
        </div>
    </td>
</tr>
