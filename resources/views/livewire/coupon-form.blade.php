<form wire:submit.prevent="submit" class="form">
    @if($errorMessage)
    <div class="alert alert-danger">
        {{ $errorMessage }}
    </div>
    @endif
    <x-form.form-group>
        <x-form.label class="required">Code</x-form.label>
        <input type="text" wire:model="code" class="form-control @error('code') is-invalid @enderror">
        <x-invalid-feedback field="code"></x-invalid-feedback>
    </x-form.form-group>

    {{-- <x-form.form-group>
            <x-form.label class="required">Description</x-form.label>
            <textarea name="description" class="form-control" id="" cols="30" rows="10"></textarea>
        </x-form.form-group> --}}

    <x-form.form-group>
        <x-form.label class="required">Coupon Type</x-form.label>
        <select wire:model="type" class="custom-select  @error('type') is-invalid @enderror">
            <option value="">Select type</option>
            <option value="{{ \App\Coupon::FIXED }}">{{ ucfirst(\App\Coupon::FIXED) }}</option>
            <option value="{{ \App\Coupon::PERCENT_OFF }}">{{ ucfirst(\App\Coupon::PERCENT_OFF) }}</option>
            {{-- <option value=submit"{{ \App\Coupon::MINIMUM_QUANTITY }}">{{ ucfirst(\App\Coupon::MINIMUM_QUANTITY) }}</option> --}}
        </select>
        <x-invalid-feedback field="type"></x-invalid-feedback>
    </x-form.form-group>

    <x-form.form-group>
        <x-form.label class="required">Start From</x-form.label>
        {{ $coupon->start_date }}
        <input type="date" wire:model="start_date" class="form-control @error('start_date') is-invalid @enderror">
        <x-invalid-feedback field="start_date"></x-invalid-feedback>
    </x-form.form-group>

    <x-form.form-group>
        <x-form.label class="required">Valid Until</x-form.label>
        <input type="date" wire:model="end_date" class="form-control @error('end_date') is-invalid @enderror">
        <x-invalid-feedback field="end_date"></x-invalid-feedback>
    </x-form.form-group>

    {{-- Fixed Value Coupon --}}
    @if ($this->type == \App\Coupon::FIXED)
    <x-form.form-group>
        <x-form.label class="required">Coupon amount</x-form.label>
        <input type="number" wire:model="fixed_amount" class="form-control @error('fixed_amount') is-invalid @enderror">
        <x-invalid-feedback field="fixed_amount"></x-invalid-feedback>
    </x-form.form-group>
    @endif

    {{-- Percent Off Coupon --}}
    @if ($this->type == \App\Coupon::PERCENT_OFF)
    <x-form.form-group>
        <x-form.label class="required">Percent Off</x-form.label>
        <input type="number" wire:model="percent_off_amount" class="form-control @error('percent_off_amount') is-invalid @enderror">
        <x-invalid-feedback field="percent_off_amount"></x-invalid-feedback>
    </x-form.form-group>
    @endif

    {{-- Minimum Quantity Coupon --}}
    {{-- <div id="minimum-quantity-coupon" x-show="type == '{{ \App\Coupon::MINIMUM_QUANTITY }}'" x-cloak>
    <x-form.form-group>
        <x-form.label>Product</x-form.label>
        <select name="{{ \App\Coupon::FIXED }}[product_id]" id="" class="custom-select">
            <option value="">Select Product</option>
            <option value="1">First Product</option>
        </select>
    </x-form.form-group>

    <x-form.form-group>
        <x-form.label class="required">Minimum Quantity</x-form.label>
        <input type="number" name="{{ \App\Coupon::FIXED }}[minimun_quantity]" class="form-control">
    </x-form.form-group>
    <x-form.form-group>
        <x-form.label class="required">Percent Off</x-form.label>
        <input type="number" name="{{ \App\Coupon::FIXED }}[percent_off]" class="form-control">
    </x-form.form-group> --}}
    {{-- </div> --}}

    <button type="submit" class="btn btn-primary px-4 ml-0">Save</button>
</form>
