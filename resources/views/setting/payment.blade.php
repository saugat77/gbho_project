@extends('layouts.admin')

@section('content')
<div>
    <h4 class="h4-responsive">{{ $title }}</h4>

    <form action="{{ route('settings.payment.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <section class="card z-depth-0">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="h4-responsive font-weight-bolder">Paypal</h4>
                            </div>

                            <div class="form-group col-md-6">
                                <x-form.label>Enable Test Mode</x-form.label>
                                <select name="paypal_enable_test_mode" class="custom-select d-block">
                                    <option value="yes">Yes</option>
                                    <option value="no" @if(old('paypal_enable_test_mode', settings('paypal_enable_test_mode')=='no' )) selected @endif>No</option>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <x-form.label>Client ID</x-form.label>
                                <x-fields.input name="paypal_client_id" :value="old('paypal_client_id', settings('paypal_client_id'))" />
                            </div>

                            <div class="form-group col-md-6">
                                <x-form.label>API Secret</x-form.label>
                                <x-fields.input name="paypal_api_secret" :value="old('paypal_api_secret', settings('paypal_api_secret'))" />
                            </div>

                            <div class="form-group col-md-6">
                                <x-form.label>Currency</x-form.label>
                                <x-fields.input name="paypal_currency" :value="old('paypal_currency', settings('paypal_currency'))" />
                                <small class="form-help">Default currency is USD.</small>
                            </div>

                        </div>
                        {{-- Right --}}
                        <div class="col-md-6">

                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary px-5 btn-lg">Save</button>
                        </div>
                    </div>
        </section>
    </form>

</div>
@endsection
