@extends('layouts.admin')

@section('content')
<div>
    <h4 class="h4-responsive">{{ $title }}</h4>

    <form action="{{ route('settings.api-and-keys.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <section class="card z-depth-0">
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-6">
                        <x-form.label>Facebook app ID</x-form.label>
                        <x-fields.input name="facebook_app_id" :value="old('facebook_app_id', settings('facebook_app_id'))" />
                    </div>

                    <div class="form-group col-md-6">
                        <x-form.label>Facebook app secret</x-form.label>
                        <x-fields.input name="facebook_app_secret" :value="old('facebook_app_secret', settings('facebook_app_secret'))" />
                    </div>

                    <div class="form-group col-md-6">
                        <x-form.label>Google client ID</x-form.label>
                        <x-fields.input name="google_client_id" :value="old('google_client_id', settings('google_client_id'))" />
                    </div>

                    <div class="form-group col-md-6">
                        <x-form.label>Google client secret</x-form.label>
                        <x-fields.input name="google_client_secret" :value="old('google_client_secret', settings('google_client_secret'))" />
                    </div>

                    <div class="form-group col-md-6">
                        <x-form.label>RECAPTCHA site key</x-form.label>
                        <x-fields.input name="recaptcha_api_site_key" :value="old('recaptcha_api_site_key', settings('recaptcha_api_site_key'))" />
                    </div>

                    <div class="form-group col-md-6">
                        <x-form.label>RECAPTCHA secret key</x-form.label>
                        <x-fields.input name="recaptcha_api_secret_key" :value="old('recaptcha_api_secret_key', settings('recaptcha_api_secret_key'))" />
                    </div>

                    <div class="form-group col-md-6">
                        <x-form.label>Facebook chat plugin code</x-form.label>
                        <textarea name="facebook_chat_plugin" id="" class="form-control" cols="30" rows="10">{{ old('facebook_chat_plugin', settings('facebook_chat_plugin')) }}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary px-4 ml-0">Save</button>
                </div>

            </div>
        </section>

        <h4 class="h4-responsive">{{ __('Additional Scripts Adder') }}</h4>
        <section class="card z-depth-0">
            <div class="card-body">
                <div class="form-group">
                    <x-form.label>Header Script</x-form.label>
                    <textarea name="header_scripts" id="" class="form-control" cols="30" rows="10">{{ old('header_scripts', settings('header_scripts')) }}</textarea>
                </div>

                <div class="form-group">
                    <x-form.label>Footer Script</x-form.label>
                    <textarea name="footer_scripts" id="" class="form-control" cols="30" rows="10">{{ old('footer_scripts', settings('footer_scripts')) }}</textarea>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary px-4 ml-0">Save</button>
                </div>

            </div>
        </section>
    </form>

</div>
@endsection
