<div class="card z-depth-0">
    <div class="card-body">
        <div class="d-flex">
            <h5 class="h5-responsive d-inline-block">{{ $category->exists ? 'Edit Category' : 'Add new category' }}</h5>
            @if($category->exists)
            <a class="btn btn-primary btn-sm my-0 ml-auto" href="{{ route('categories.index') }}">Add New</a>
            @endif
        </div>
        <form action="{{ $category->exists ? route('categories.update', $category) : route('categories.store') }}" method="POST" class="form">
            @csrf
            @if($category->exists)
            @method('put')
            @endif
            <x-form.form-group for="name">
                <x-form.label class="required">Name</x-form.label>
                <x-fields.text name="name" :value="old('name', $category->name)" />
            </x-form.form-group>

            @if($category->exists)
            <x-form.form-group label="Slug">
                <x-fields.text name="slug" :value="old('slug', $category->slug)" />
            </x-form.form-group>
            @endif

            <x-form.form-group label="Parent Cateogry">
                <select name="parent_id" class="custom-select {{ invalid_class('parent_id') }}" id="">
                    <option value="">None</option>
                    @foreach($parentCategories as $firstLevelCategory)
                        <option value="{{ $firstLevelCategory->id }}" @if($category->parentCategory && ($category->parentCategory->id == $firstLevelCategory->id)) selected @endif>
                            {{ $firstLevelCategory->name }}
                        </option>
                        @foreach($firstLevelCategory->childcategories as $secondLevelCat)
                            <option value="{{ $secondLevelCat->id }}" @if($category->parentCategory && ($category->parentCategory->id == $secondLevelCat->id)) selected @endif>
                                -- {{ $secondLevelCat->name }}
                            </option>
                        @endforeach
                    @endforeach
                </select>
                <x-invalid-feedback field="parent_id"></x-invalid-feedback>
            </x-form.form-group>

            <x-form.form-group label="Description">
                <textarea name="description" class="form-control {{ invalid_class('description') }}" rows="5">{{ old('description', $category->description) }}</textarea>
                <x-invalid-feedback field="description"></x-invalid-feedback>
            </x-form.form-group>

            <div class="form-group">
                <button type="submit" class="btn btn-primary z-depth-0 text-capitalize">{{ $category->exists ? 'Update Category': 'Add new category' }}</button>
            </div>

        </form>
    </div>
</div>
