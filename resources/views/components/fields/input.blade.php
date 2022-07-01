<input name="{{ $name }}" {{ $attributes->merge(['type' => 'text', 'class' => 'form-control '. invalid_class($name)]) }}" value="{{ $value ?? null }}">
<x-invalid-feedback :field="$name"></x-invalid-feedback>
