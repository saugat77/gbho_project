<div {{ $attributes->merge(['class' => 'form-group']) }}>
    @isset($label)
    <label for="{{ $for ?? '' }}" @isset($required) class="required" @endisset">{{ $label }}</label>
    @endisset
    {{ $slot }}
</div>
