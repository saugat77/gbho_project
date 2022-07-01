<div>
    <form action="{{ $post->exists ? route('posts.update', $post) : route('posts.store') }}" method="post" class="form" enctype="multipart/form-data">
        @csrf
        @if($post->exists)
        @method('put')
        @endif
        <div class="row">
            <div class="col-md-9">
                <x-box>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <input type="text" name="title" class="form-control form-control-lg rounded-0 {{ invalid_class('title') }}" value="{{ old('title', $post->title) }}" placeholder="Add title">
                            <x-invalid-feedback field="title"></x-invalid-feedback>
                        </div>

                        @if($post->exists)
                        <div class="col-md-12 form-group">
                            <script>
                                function togglepostlugInput() {
                                    postlugInput = document.getElementById('post-slug');
                                    if (postlugInput.style.display === "none") {
                                        postlugInput.style.display = "block";
                                    } else {
                                        postlugInput.style.display = "none";
                                    }
                                    return false;
                                }

                            </script>
                            <label for="slug" class="text-muted">Slug: {{ $post->slug }} <a href="#" onclick="return togglepostlugInput()">Edit</a></label>
                            <input type="text" name="slug" id="post-slug" class="form-control {{ invalid_class('slug') }}" value="{{ old('slug', $post->slug) }}" @if(!$post->exists) disabled @endif style="display: none;">
                            <x-invalid-feedback field="slug"></x-invalid-feedback>
                        </div>
                        @endif

                    </div>
                </x-box>

                <x-box class="my-3">
                    <textarea name="content" id="content" class="form-control {{ invalid_class('content') }}" cols="30" rows="10">{{ old('content', $post->content) }}</textarea>
                    <x-invalid-feedback field="content"></x-invalid-feedback>
                </x-box>

                <x-box class="my-3">
                    <label for="post_category_id">SEO</label>
                    <div class="form-group">
                        <input type="text" name="seo_title" class="form-control bg-light {{ invalid_class('seo_title') }}" placeholder="title" value="{{ old('seo_title', $post->seo_title) }}">
                        <x-invalid-feedback field="seo_title"></x-invalid-feedback>
                    </div>
                    <div class="form-group">
                        <textarea name="seo_description" id="seo_description" class="form-control bg-light {{ invalid_class('seo_description') }}" cols="30" rows="5" maxlength="{{ \App\Post::SEO_DESCRIPTION_LENGTH }}">{{ old('seo_description', $post->seo_description) }}</textarea>
                        <small class="small form-help">Max {{ \App\Post::SEO_DESCRIPTION_LENGTH }} characters. Remaining: 25</small>
                        <x-invalid-feedback field="seo_description"></x-invalid-feedback>
                    </div>
                </x-box>

            </div>
            {{-- End of col-md-8 --}}
            <div class="col-md-3">
                <x-box class="d-none d-md-block">
                    <button type="submit" name="is_draft" value="0" class="btn btn-primary w-100 mx-0">{{ __('Publish') }}</button>
                    <button type="submit" name="is_draft" value="1" class="btn btn-sm btn-danger w-100 mx-0 my-2">{{ __('Save as Draft') }}</button>
                    @if($post->exists)
                    @if(Route::has('posts.show'))
                    <a href="{{ route('posts.show', $post) }}" class="btn btn-outline-primary btn-sm rounded-0 w-100 z-depth-0 mx-0 mt-2" target="_blank">View</a>
                    @endif
                    <div class="text-muted mt-2">
                        Status: <span class="font-weight-bolder">{{ $post->isPublished() ? 'Published' : 'Draft' }}</span>
                    </div>
                    @endif
                </x-box>

                <div class="my-3"></div>

                <x-box>
                    <div class="text-center">
                        @php
                        if ( $post->exists && $post->cover_image) {
                        $imageUrl = $post->imageUrl();
                        } else {
                        $imageUrl = 'https://dummyimage.com/1200x600/f4f6f9/0011ff';
                        }
                        @endphp
                        <div class="position-relative">
                            <img id="postImagePreview" class="img-fluid" src="{{ $imageUrl }}" alt="" style="max-height: 300px;">
                            <input type="file" name="cover_image" id="postImage" value="{{ old('image') }}" accept="image/*" hidden>
                            <label for="postImage" class="position-absolute" style="bottom: 0;
                                        left: 10px;
                                        padding: 5px 10px;
                                        border-radius: 5px;
                                        background-color: #24292e;
                                        color: #fff;
                                        font-size: 0.8em;
                                        cursor: pointer;">
                                <i class="fa fa-camera mr-2"></i> {{ $post->exists ? 'Change' : 'Choose' }} Image
                            </label>
                        </div>
                        @error('image')
                        <div class="text-left text-danger text-sm mt-2">{{ $message }}</div>
                        @enderror
                        <script>
                            let postImage = document.getElementById('postImage');
                            let postImagePreview = document.getElementById('postImagePreview');

                            function reloadpostImageUrl(input) {
                                if (input.files && input.files[0]) {
                                    var reader = new FileReader();
                                    reader.onload = function(e) {
                                        postImagePreview.setAttribute('src', e.target.result);
                                    }
                                    reader.readAsDataURL(input.files[0]);
                                }
                            }
                            postImage.addEventListener("change", function() {
                                reloadpostImageUrl(this);
                            });

                        </script>
                    </div>
                </x-box>

                <x-box class="mt-3">
                    <label for="excerpt">Excerpt</label>
                    <textarea name="excerpt" id="excerpt" class="form-control bg-light {{ invalid_class('excerpt') }}" cols="30" rows="5" maxlength="{{ \App\Post::EXCERPT_LENGTH }}">{{ old('excerpt', $post->excerpt) }}</textarea>
                    <small class="small form-help">Max {{ \App\Post::EXCERPT_LENGTH }} characters. Remaining: 25</small>
                    <x-invalid-feedback field="excerpt"></x-invalid-feedback>
                </x-box>

            </div>

            <div class="col-md-12 d-block d-md-none">
                <x-box>
                    <button type="submit" name="is_draft" value="0" class="btn btn-primary w-100 mx-0">{{ __('Publish') }}</button>
                    <button type="submit" name="is_draft" value="1" class="btn btn-sm btn-danger w-100 mx-0 my-2">{{ __('Save as Draft') }}</button>
                    @if($post->exists)
                    @if(Route::has('posts.show'))
                    <a href="{{ route('posts.show', $post) }}" class="btn btn-outline-primary btn-sm rounded-0 w-100 z-depth-0 mx-0 mt-2" target="_blank">View</a>
                    @endif
                    <div class="text-muted mt-2">
                        Status: <span class="font-weight-bolder">{{ $post->isPublished() ? 'Published' : 'Draft' }}</span>
                    </div>
                    @endif
                </x-box>

            </div>

        </div>
    </form>
</div>

@push('scripts')
<script type="text/javascript" id="feature-input-template">
    <div class="bg-light d-flex justify-content-between white p-3">
        <div class="align-self-center flex-grow-1">
            <input type="text" name="features[]" class="form-control">
        </div>
        <button type="button" class="specfication-remove-btn btn btn-danger btn-md my-0 font-roboto ml-3"><span class="mr-2"><i class="fa fa-times"></i></span>Remove</button>
    </div>

</script>
<script>
    $(function() {
        $('#content').summernote({
            placeholder: 'Post content goes here...'
            , tabsize: 2
            , height: 400
        });
    });

</script>
@endpush