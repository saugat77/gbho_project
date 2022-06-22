@extends('layouts.admin')

@section('content')
<div>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Users</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
                        <li class="breadcrumb-item active">{{ $user->name }}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <div>
        @include('alerts.all')
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card z-depth-0 border">
                <div class="card-header bg-light">User Details</div>
                <div class="card-body">
                    <form action="{{ route('users.update', $user) }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="form-row">
                            <div class="col-md-6">
                                <x-form.form-group>
                                    <x-form.label class="required">Name</x-form.label>
                                    <x-fields.input name="name" :value="old('name', $user->name)" />
                                </x-form.form-group>
                            </div>
                            <div class="col-md-6">
                                <x-form.form-group>
                                    <x-form.label class="required">Email</x-form.label>
                                    <x-fields.input type="email" name="email" :value="old('email', $user->email)" />
                                </x-form.form-group>
                            </div>
                            <div class="col-md-6">
                                <x-form.form-group>
                                    <x-form.label>Mobile</x-form.label>
                                    <x-fields.input name="mobile" :value="old('mobile', $user->mobile)" />
                                </x-form.form-group>
                            </div>
                            <div class="col-md-12">
                                <x-form.form-group>
                                    <x-form.label class="d-block required">Gender</x-form.label>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" name="gender" class="custom-control-input" id="radio-gender-male" value="male" @if(old('gender', $user->gender) == 'male') checked @endif>
                                        <label class="custom-control-label" for="radio-gender-male">Male {{ old('gender', $user->gender) }}</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" name="gender" class="custom-control-input" id="radio-gender-female" value="female" @if(old('gender', $user->gender) == 'female') checked @endif>
                                        <label class="custom-control-label" for="radio-gender-female">Female</label>
                                    </div>
                                    <x-tailwind-invalid-feedback field="gender" class="text-danger"></x-tailwind-invalid-feedback>
                                </x-form.form-group>
                            </div>
                            <div class="col-md-6">
                                <x-form.form-group>
                                    <x-form.label class="required">Roles</x-form.label>
                                    <div>
                                        @foreach(config('authorization.roles') as $role)
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="roles" class="custom-control-input" id="role-checkbox-{{ $role }}" value="{{ $role }}" @if($user->hasRole($role)) checked @endif>
                                            <label class="custom-control-label mr-2" for="role-checkbox-{{ $role }}">{{ ucfirst($role) }}</label>
                                        </div>
                                        @endforeach
                                    </div>
                                    <x-tailwind-invalid-feedback field="roles" class="text-danger"></x-tailwind-invalid-feedback>
                                </x-form.form-group>
                            </div>
                            <div class="col-md-12">
                                <x-form.form-group>
                                    <button type="submit" class="btn btn-primary text-capitalize rounded-0 mx-0">Update [{{ $user->name }}]</button>
                                </x-form.form-group>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card z-depth-0 border" style="max-width: 800px;">
                <div class="card-header bg-light">Reset Password</div>
                <div class="card-body">
                    <form action="{{ route('users.change-password', $user) }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="form-row">
                            <div class="col-md-12">
                                <x-form.form-group>
                                    <x-form.label class="required">Password</x-form.label>
                                    <x-fields.input type="password" name="password" autocomplete="off" />
                                </x-form.form-group>
                            </div>
                            <div class="col-md-12">
                                <x-form.form-group>
                                    <x-form.label class="required">Confirm Password</x-form.label>
                                    <x-fields.input type="password" name="password_confirmation" />
                                </x-form.form-group>
                            </div>
                            <div class="col-md-12">
                                <x-form.form-group>
                                    <button type="submit" class="btn btn-primary text-capitalize rounded-0 mx-0">Change Password</button>
                                </x-form.form-group>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
