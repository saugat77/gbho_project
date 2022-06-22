@extends('layouts.admin')

@section('content')
<div>
    <h4 class="h4-responsive">{{ $title }}</h4>

    <form action="{{ route('settings.general.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <section class="card z-depth-0">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="h4-responsive font-weight-bolder">Site</h4>
                            </div>

                            <div class="form-group col-md-6">
                                <x-form.label>Site name</x-form.label>
                                <x-fields.input name="site_name" :value="old('site_name', settings('site_name'))" />
                            </div>

                            <div class="form-group col-md-6">
                                <x-form.label>Tagline</x-form.label>
                                <x-fields.input name="tagline" :value="old('tagline', settings('tagline'))" />
                            </div>

                            <div class="form-group col-md-12">
                                <x-form.label>Site Logo</x-form.label>
                                <div class="input-group">
                                    @if(settings()->get('site_logo'))
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="site-logo-prepend">
                                            <img src="{{ asset('storage/' . settings()->get('site_logo')) }}" alt="" style="height:1.5em;">
                                        </span>
                                    </div>
                                    @endif
                                    <div class="custom-file">
                                        <input type="file" name="site_logo" class="custom-file-input" id="site-logo-input" aria-describedby="site-logo-prepend">
                                        <label class="custom-file-label" for="site-logo-input">Choose file</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <x-form.label>Favicon</x-form.label>
                                <div class="input-group">
                                    @if(settings()->get('favicon'))
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupFileAddon01">
                                            <img src="{{ asset('storage/' . settings()->get('favicon')) }}" alt="" style="height:1.5em;">
                                        </span>
                                    </div>
                                    @endif
                                    <div class="custom-file">
                                        <input type="file" name="favicon" class="custom-file-input" id="favicon-input" aria-describedby="inputGroupFileAddon01">
                                        <label class="custom-file-label" for="favicon-input">Choose file</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 mt-3">
                                <h4 class="h4-responsive font-weight-bolder">Pricing</h4>
                            </div>
                            <div class="form-group col-md-12">
                                <x-form.label>Currency unit</x-form.label>
                                <x-fields.input name="price_unit" :value="old('price_unit', settings('price_unit'))" />
                            </div>

                            <div class="form-group col-md-6">
                                <x-form.label>Shipping Charge</x-form.label>
                                <x-fields.input name="shipping_charge" :value="old('shipping_charge', settings('shipping_charge'))" />
                                <small class="form-help">Default shipping charge is Rs. 100</small>
                            </div>

                            {{-- <div class="form-group col-md-6">
                                <x-form.label>Tax percent</x-form.label>
                                <x-fields.input type="number" name="tax_percent" :value="old('tax_percent', settings('tax_percent'))" />
                            </div> --}}

                            <div class="form-group col-md-6">
                                <x-form.label>Low stock threshold</x-form.label>
                                <x-fields.input type="number" name="low_stock_threshold" :value="old('low_stock_threshold', settings('low_stock_threshold'))" />
                            </div>

                            <div class="form-group col-md-12">
                                <x-form.label>Enable RECAPTCHA on register</x-form.label>
                                <select name="register_enable_captcha" class="custom-select d-block w-25">
                                    <option value="yes">Yes</option>
                                    <option value="no" @if(old('register_enable_captcha', settings('register_enable_captcha')=='no' )) selected @endif>No</option>
                                </select>
                                <small class="form-text">If enabled please configure recaptcha credentials in API & Keys settings</small>
                            </div>
                        </div>
                    </div>
                    {{-- Right --}}
                    <div class="col-md-6">
                        <div class="col-md-12">
                            <h4 class="h4-responsive font-weight-bolder">Topbar</h4>
                        </div>

                        <div class="form-group col-md-12">
                            <x-form.label>Show Top Bar</x-form.label>
                            <select name="show_top_bar" class="custom-select d-block w-25">
                                <option value="yes">Yes</option>
                                <option value="no" @if(old('show_top_bar', settings('show_top_bar')=='no' )) selected @endif>No</option>
                            </select>
                        </div>

                        <div class="form-group col-md-12">
                            <x-form.label>Topbar Mobile</x-form.label>
                            <x-fields.input name="topbar_mobile" :value="old('topbar_mobile', settings('topbar_mobile'))" />
                        </div>

                        <div class="form-group col-md-12">
                            <x-form.label>Topbar E-mail</x-form.label>
                            <x-fields.input name="topbar_email" :value="old('topbar_email', settings('topbar_email'))" />
                        </div>

                        <div class="col-md-12">
                            <h4 class="h4-responsive font-weight-bolder">Bottom Bar</h4>
                        </div>
                        <div class="form-group col-md-12">
                            <x-form.label>Show Bottom Bar</x-form.label>
                            <select name="show_bottom_bar" class="custom-select d-block w-25">
                                <option value="yes">Yes</option>
                                <option value="no" @if(old('show_bottom_bar', settings('show_bottom_bar') == 'no')) selected @endif>No</option>
                            </select>
                        </div>
        
                        <div class="form-group col-md-12">
                            <x-form.label>Footer left text</x-form.label>
                            <textarea name="footer_left_text" class="form-control" rows="5">{{ old('footer_left_text', settings('footer_left_text')) }}</textarea>
                        </div>
        
                        <div class="form-group col-md-12">
                            <x-form.label>Footer right text</x-form.label>
                            <textarea name="footer_right_text" class="form-control" rows="5">{{ old('footer_right_text', settings('footer_right_text')) }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary px-5 btn-lg">Save</button>
                </div>
            </div>
        </section>
    </form>

</div>
@endsection
