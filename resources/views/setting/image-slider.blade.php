@extends('layouts.admin')

@section('content')
<div>
    <h4 class="h4-responsive">{{ $title }}</h4>

    <form action="{{ route('settings.image-sliders.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <x-box class="rounded" style="max-width: 500px;">
            <div class="form-group">
                <x-form.label>Autoplay Speed</x-form.label>
                <x-fields.input name="primary_image_slider_autoplay_speed" :value="old('primary_image_slider_autoplay_speed', settings('primary_image_slider_autoplay_speed'))" />
                <div class="form-text small text-muted">In milliseconds. Default is 400</div>
            </div>

            <div class="form-group">
                <x-form.label>Autoplay Delay</x-form.label>
                <x-fields.input name="primary_image_slider_autoplay_delay" :value="old('primary_image_slider_autoplay_delay', settings('primary_image_slider_autoplay_delay'))" />
                <div class="form-text small text-muted">In milliseconds. Default is 5000</div>
            </div>

            <div class="form-group">
                <x-form.label>Show Navigation Arrows</x-form.label>
                <select name="primary_image_slider_show_navigation" class="custom-select d-block">
                    <option value="yes">Yes</option>
                    <option value="no" @if(old('primary_image_slider_show_navigation', settings('primary_image_slider_show_navigation')=='no' )) selected @endif>No</option>
                </select>
            </div>

            <div class="form-group">
                <x-form.label>Show Pagination Bullets</x-form.label>
                <select name="primary_image_slider_show_pagination" class="custom-select d-block">
                    <option value="yes">Yes</option>
                    <option value="no" @if(old('primary_image_slider_show_pagination', settings('primary_image_slider_show_pagination')=='no' )) selected @endif>No</option>
                </select>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary px-4">Save</button>
            </div>
        </x-box>
    </form>

</div>
@endsection
