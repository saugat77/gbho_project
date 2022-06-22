@extends('layouts.admin')

@section('content')
<div>
    <h4 class="h4-responsive">{{ $title }}</h4>

    <form action="{{ route('settings.email.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <x-box class="rounded">
            <h5 class="h5-responsive mb-3">Mail Configuration</h5>
            <div class="row">
                <div class="form-group col-md-6">
                    <x-form.label>Mail Driver</x-form.label>
                    <select name="mail_driver" class="custom-select d-block">
                        <option value="smtp">SMTP</option>
                        <option value="log" @if(old('mail_driver', settings('mail_driver')=='log' )) selected @endif>Log</option>
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <x-form.label>Host</x-form.label>
                    <x-fields.input name="mail_host" :value="old('mail_host', settings('mail_host'))" />
                </div>

                <div class="form-group col-md-6">
                    <x-form.label>Port</x-form.label>
                    <x-fields.input name="mail_port" :value="old('mail_port', settings('mail_port'))" />
                </div>

                <div class="form-group col-md-6">
                    <x-form.label>Encryption</x-form.label>
                    <x-fields.input name="mail_encryption" :value="old('mail_encryption', settings('mail_encryption'))" />
                </div>

                <div class="form-group col-md-6">
                    <x-form.label>Username</x-form.label>
                    <x-fields.input name="mail_username" :value="old('mail_username', settings('mail_username'))" />
                </div>

                <div class="form-group col-md-6">
                    <x-form.label>Password</x-form.label>
                    <x-fields.input name="mail_password" :value="old('mail_password', settings('mail_password'))" />
                </div>

                <div class="form-group col-md-6">
                    <x-form.label>Mail From Address</x-form.label>
                    <x-fields.input name="mail_from_address" :value="old('mail_from_address', settings('mail_from_address'))" />
                </div>

                <div class="form-group col-md-6">
                    <x-form.label>Mail From Name</x-form.label>
                    <x-fields.input name="mail_from_name" :value="old('mail_from_name', settings('mail_from_name'))" />
                </div>

            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary px-4 ml-0">Save</button>
            </div>

        </x-box>
    </form>

    <div class="my-4"></div>
    <x-box class="rounded" style="max-width: 500px;">

        <form action="{{ route('settings.email.send-test-email') }}" method="POST">
            @csrf
            <div class="form-group">
                <x-form.label>Send test email to:</x-form.label>
                <x-fields.input type="email" name="email" :value="old('email', settings('email'))" placeholder="email@example.com" />
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary px-4 ml-0">Send Now</button>
            </div>
        </form>
    </x-box>
</div>
@endsection
