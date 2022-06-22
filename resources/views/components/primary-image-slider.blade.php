<div id="primary-slider-loading-block" class="aspect-w-16 aspect-h-4">
    <div class="block h-full w-full animate-pulse bg-gradient-to-r from-gray-400 via-gray-500 to-gray-400"></div>
</div>

<div class="relative">
    <div class="swiper-container primary-slider">

        <div id="primary-slider" class="swiper-wrapper">
            <!-- Slides -->
        </div>

        @if(settings('primary_image_slider_show_pagination', 'yes') == 'yes')
        <div class="swiper-pagination"></div>
        @endif

        @if(settings('primary_image_slider_show_navigation', 'yes') == 'yes')
        <div class="absolute top-0 left-0 z-10 h-full flex items-center">
            <button class="pis-left-btn bg-gray-800 text-gray-100 opacity-75 hover:opacity-100 rounded-r py-3 sm:py-8 px-1 sm:px-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-width="3" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>
        </div>
        <div class="absolute top-0 right-0 z-10 h-full flex items-center">
            <button class="pis-right-btn bg-gray-800 text-gray-100 opacity-75 hover:opacity-100 rounded-l py-3 sm:py-8 px-1 sm:px-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-width="3" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
        </div>
        @endif

    </div>
</div>

@push('scripts')
<script>
    // Primary Image Slider initialization
    function initializePrimarySlider() {
        var primaryImageSlider = new Swiper('.primary-slider', {
                    speed: <?php echo settings('primary_image_slider_autoplay_speed', 400) ?? 400 ?>
            , loop: true
            , autoplay: {
                delay: <?php echo settings('primary_image_slider_autoplay_delay', 5000) ?? 5000 ?>
                , disableOnInteraction: false
            }
            , waitForTransition: false
            , pagination: {
                el: '.swiper-pagination'
                , type: 'bullets'
            , },
            // Navigation arrows
            navigation: {
                nextEl: '.pis-right-btn'
                , prevEl: '.pis-left-btn'
            }
        });
    }

    // Load Partners Data
    const url = "{{ route('api.image-sliders.index', ['group' => 'primary']) }}";
    console.log(url);
    const primarySlider = document.getElementById('primary-slider');

    fetch(url)
        .then(response => {
            response = response.json();
            return response;
        })
        .then(response => {
            response.forEach(imageSlider => {
                let content =
                    `<div class="swiper-slide aspect-w-16 aspect-h-5 sm:aspect-h-4">`;

                if (imageSlider.action_link) {
                    content = content + `<a class="block" href="${imageSlider.action_link}"`;
                    if (imageSlider.open_in_new_tab) {
                        content = content + 'target="_blank">';
                    } else {
                        content += '>';
                    }

                }

                content += `<img class="primary-image-slider-image w-full" src="${imageSlider.image_url}" >`;

                if (imageSlider.action_link) {
                    content += `</a>`;
                }
                content += `</div>
                    `;

                primarySlider.innerHTML += content;
            })
        }).then(() => {
            // hide loading block
            document.getElementById('primary-slider-loading-block').style.display = 'none';
            // initialize slider
            initializePrimarySlider();
        });

</script>
@endpush
