<div class="sm:py-4">
    <div class="sm:container mx-auto">
        <div class="grid grid-cols-12 sm:gap-4">
            <div class="col-span-12 sm:col-span-3">

                {{-- Left sidebar visible in  desktop --}}
                <div class="hidden md:block md:p-3 bg-gray-10">
                    <livewire:customer-side-nav />
                </div>

                {{-- Right content --}}
                <div class="col-span-12 sm:col-span-9">
                    @isset($mobileHeading)
                    <div class="md:hidden mb-3">
                        {{ $mobileHeading }}
                    </div>
                    @endisset

                    @isset($heading)
                    <div class="hidden md:block">
                        {{ $heading }}
                    </div>
                    @endisset

                    {{ $slot }}
                </div>

            </div>
        </div>
    </div>
