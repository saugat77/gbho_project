<div class="text-xs border">
    @foreach($categoryMenus as $category)
    <div class="category-dropdown relative flex justify-between px-3 py-2 bg-white text-gray-800 items-center hover:bg-theme-red hover:bg-main-50 hover:text-primary whitespace-no-wrap w-full">
        <a class="flex-grow" href="{{ route('frontend.products.index', ['category' => $category->slug]) }}">{{ ucfirst($category->name) }}</a>
        <span class="text-gray-500">
            <svg class="h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
              </svg>
        </span>
        <div class="category-dropdown-menu hidden absolute shadow-lg w-48">
            <div class="rounded bg-gray-200 m-px">
                @foreach($category->childcategories as $category)
                <div class="category-dropdown-item">
                    <div class="category-dropdown relative flex justify-between px-3 py-2 bg-white text-gray-800 items-center hover:bg-theme-red hover:bg-main-50 whitespace-no-wrap">
                        <a class="category-dropdown-item flex-grow truncate" href="{{ route('frontend.products.index', ['category' => $category->slug]) }}">{{ ucfirst($category->name)}}</a>
                        <a class="category-dropdown-item" href="{{ route('frontend.products.index', ['category' => $category->slug]) }}">
                            <span class="text-gray-500">
                                <svg class="h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                  </svg>
                            </span>
                        </a>
                        <div class="category-dropdown-menu hidden absolute shadow-lg w-48">
                            <div class="bg-white">
                                @foreach($category->childcategories as $category)
                                <div class="category-dropdown-item">
                                    <a class="category-dropdown-link flex px-3 py-2 text-gray-800 whitespace-no-wrap hover:bg-theme-red hover:bg-main-50" href="{{ route('frontend.products.index', ['category' => $category->slug]) }}">{{ ucfirst($category->name) }}</a>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endforeach
    
    @push('scripts')
    <script>
        $(function() {
            $('.category-dropdown').each(function(_, dropdown) {
                const dropdownMenu = $(dropdown).find('> .category-dropdown-menu')[0];
                let popperInstance = null;

                function create() {
                    popperInstance = Popper.createPopper(dropdown, dropdownMenu, {
                        placement: 'auto-start'
                        , strategy: 'absolute'
                        , modifiers: [{
                            name: 'flip'
                            , options: {
                                fallbackPlacements: ['top', 'bottom', 'left', 'right']
                            , }
                        }]
                    });
                }

                function destroy() {
                    if (popperInstance) {
                        popperInstance.destroy();
                        popperInstance = null;
                    }
                }

                function show() {
                    console.log('showing menu');
                    $(dropdownMenu).attr('data-show', '');
                    create();
                }

                function hide() {
                    console.log('hiding menu');
                    $(dropdownMenu).removeAttr('data-show');
                    destroy();
                }

                $(dropdown).on('mouseenter', show);
                $(dropdown).on('mouseleave', hide);

            });
        });

    </script>

    @endpush
</div>
