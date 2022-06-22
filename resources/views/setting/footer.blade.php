@extends('layouts.admin')

@section('content')
<div>
    <h4 class="h4-responsive">{{ $title }}</h4>

    {{-- @include('alerts.success') --}}

    <form action="{{ route('settings.footer.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <section class="card z-depth-0">
            <div class="card-body">
                <div class="form-group">
                    <x-form.label>About us short text</x-form.label>
                    <textarea name="about_us_short_text" id="" class="form-control" cols="30" rows="10">{{ old('about_us_short_text', settings()->get('about_us_short_text')) }}</textarea>
                </div>

                 <div class="form-group">
                    <x-form.label>About us page slug</x-form.label>
                    {{-- <x-fields.input name="about_us_page_slug" :value="old('about_us_page_slug', settings()->get('about_us_page_slug'))" /> --}}
                    @include('setting.fields.page-selector', ['settingKey' => 'about_us_page_slug'])
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary px-4 ml-0">Save</button>
                </div>

            </div>
        </section>
    </form>

</div>
@endsection
