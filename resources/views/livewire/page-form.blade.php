<form wire:submit.prevent="save">
    <div class="row">
        <div class="col-md-8">
            <x-box>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <input type="text" wire:model.defer="page.title" class="form-control form-control-lg rounded-0 @error('page.title') is-invalid @enderror" placeholder="Add Title">
                        <x-invalid-feedback field="page.title"></x-invalid-feedback>
                    </div>
                    <div class="col-md-12">
                        <x-form.label>Description</x-form.label>
                        <div wire:ignore wire:key="main-content">
                            <textarea wire:model.defer="page.content" id="content" class="form-control @error('page.content') is-invalid @enderror" cols="30" rows="10"></textarea>
                        </div>
                        @error('page.content')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </x-box>
        </div>
        <div class="col-md-4">
            <x-box>
                <button type="submit" class="btn btn-primary rounded-0 w-100 mx-0">{{ $this->updateMode ? 'Update' : 'Save' }}</button>
                @if($this->updateMode)
                <a href="{{ route('frontend.pages.show', $page) }}" class="btn btn-outline-primary btn-sm rounded-0 w-100 z-depth-0 mx-0" target="_blank">View</a>
                @endif
                <div class="text-muted">
                    Status: <span class="font-weight-bolder">Active</span>
                </div>
            </x-box>
            <br>
            <x-box>
                <div class="custom-control custom-checkbox">
                    <input wire:model.defer="page.show_breadcrumbs" class="custom-control-input" type="checkbox" value="1" id="checkbox-show-breadcrumbs">
                    <label class="custom-control-label" for="checkbox-show-breadcrumbs">
                        Show Breadcrumbs
                    </label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input wire:model.defer="page.show_title" class="custom-control-input" type="checkbox" value="1" id="checkbox-show-title">
                    <label class="custom-control-label" for="checkbox-show-title">
                        Show Title
                    </label>
                </div>
            </x-box>
            <br>
            <x-box>
                <x-form.label>Excerpt</x-form.label>
                <textarea wire:model.defer="page.excerpt" id="" class="form-control @error('page.excerpt') is-invalid @enderror" cols="30" rows="5"></textarea>
                <x-invalid-feedback field="page.excerpt"></x-invalid-feedback>
            </x-box>
            <br>
            <x-box>
                <div class="text-center">
                    <div class="position-relative">
                        <img id="pageImagePreview" class="img-fluid" src="{{ $featuredImageUrl }}" style="max-height: 300px;">
                        <input type="file" wire:model="featuredImage" wire:key="featured-image" id="pageImage" accept="image/*" hidden>
                        <label for="pageImage" class="position-absolute" style="bottom: 0;
                                    left: 10px;
                                    padding: 5px 10px;
                                    border-radius: 5px;
                                    background-color: #24292e;
                                    color: #fff;
                                    font-size: 0.8em;
                                    cursor: pointer;">
                            <i class="fa fa-camera mr-2"></i> Change Featured Image
                        </label>
                    </div>
                    @error('featuredImage')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                    @if($page->hasFeaturedImage())
                    @if($confirmFeaturedImageRemoval)
                    <button wire:click.prevent="$set('confirmFeaturedImageRemoval', false)" class="btn btn-light btn-md">Nevermind</button>
                    <button wire:click.prevent="removeFeaturedImage" class="btn btn-success btn-md">Sure</button>
                    @else
                    <button wire:click.prevent="$set('confirmFeaturedImageRemoval', true)" class="btn btn-danger btn-md">Remove Image</button>
                    @endif
                    @endif
                </div>
            </x-box>
        </div>
    </div>
</form>

@push('scripts')
<script>
    $(function() {
        $('#content').summernote({
            placeholder: 'Start writing...'
            , tabsize: 2
            , height: 500
            , callbacks: {
                onChange: function(contents, $editable) {
                    @this.set('page.content', contents);
                }
            }
        });
    });

</script>
@endpush
