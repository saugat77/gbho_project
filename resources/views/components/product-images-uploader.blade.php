<div>
    <div class="white p-3">
        <form id="myAwesomeDropzone" action="{{ route('api.product-images.store') }}" method="post" class="dropzone" enctype="form-data/multipart">
            @csrf
            <div class="fallback">
                <input name="file" type="file" accept="image/*" multiple />
            </div>
            <div class="dz-default dz-message">
                <span><strong>Drag & Drop</strong> product images here to upload or </span>
                <div class="my-3">
                    <div class="btn btn-info z-depth-0">Browse Images</div>
                </div>
            </div>
            <input type="number" name="product_id" value="{{ $product->id }}" hidden="true">
            <div class="dropzone-previews"></div>
        </form>

        <div id="productImages"></div>
    </div>

    <script type="text/template" id="image-template">
        <div class="img-wrap">seo
            <img class="img-fluid" src="" alt="">
            <div class="del-btn-wrapper">
                <button class="del-image-btn" title="delete"><span class="icon"><i class="fa fa-times-circle"></i></span></button>
            </div>
		</div>
	</script>

    <script type="text/template" id="no-image-template">
        <div id="no-image">
		<div class="image-icon">
			<i class="far fa-image"></i>
		</div>
		<div class="text">
			<strong>OOPS !!</strong>
			No Images yet. Please upload some.
		</text>
	</div>
</script>
    @push('scripts')
    <script>
        Dropzone.autoDiscover = false;
        $(function() {
            var images = $('#productImages');
            var imageTemplate = $('#image-template').html();
            var noImageTemplate = $('#no-image-template').html();
            var deleteUrl = "{{ route('api.product-images.destroy', 'IMAGE_ID ') }}";
            console.log(deleteUrl);

            function renderImageTemplate(image) {
                var templateItem = $(imageTemplate);
                templateItem.find('img').attr('src', image.url);
                templateItem.find('.del-image-btn').attr('data-id', image.id)
                images.append(templateItem);
            }

            function renderNoImageTemplate() {
                images.append(noImageTemplate)
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });

            function loadImages() {
                $.ajax("{{ route('api.product-images.index', $product) }}", {
                    dataType: 'json'
                    , success: function(data, status, xhr) {
                        // console.log(data);
                        images.empty();
                        console.log(typeof(data));
                        if (jQuery.isEmptyObject(data)) {
                            renderNoImageTemplate();
                        } else {
                            data.forEach(function(image) {
                                renderImageTemplate(image);
                            });
                        }
                    }
                    , error: function(jqXhr, textStatus, errorMessage) {
                        console.log(errorMessage);
                    }
                });
                console.log("Images Reloaded");
            }
            loadImages();
            var myAwesomeDropzone = new Dropzone("form#myAwesomeDropzone", {
                acceptedFiles: '.png,.jpg,.jpeg,.gif'
                , previewsContainer: '.dropzone-previews'
                , init: function() {
                    var myDropzone = this;
                    this.on("sendingmultiple", function() {});
                    this.on("successmultiple", function(files, response) {
                        console.log(response);
                    });
                    this.on("errormultiple", function(files, response) {
                        console.log(response);
                    });
                    this.on('complete', function(file, response) {
                        console.log('upload complete');
                        this.removeFile(file);
                        loadImages();
                    });
                }
            });
            images.on('click', '.del-image-btn', function(e) {
                event.preventDefault();
                var con = confirm('Are you absolutely sure to delete this image?');
                if (con) {
                    var dummyUrl = deleteUrl;
                    var imageDeleteUrl = dummyUrl.replace(/IMAGE_ID/, $(this).data('id'));
                    console.log("requesting to " + imageDeleteUrl);
                    $(this).hide();
                    $.ajax({
                            url: imageDeleteUrl
                            , type: 'POST'
                            , data: {
                                _method: 'delete'
                            }
                        , })
                        .done(function(response) {
                            console.log("success");
                        })
                        .fail(function(response) {
                            console.log("error");
                        })
                        .always(function() {
                            loadImages();
                            console.log("complete");
                        });
                    return false;
                } else {
                    return false;
                }
            });
        });

    </script>
    @endpush
</div>
