<input name="{{ $name }}" {{ $attributes->merge(['class' => 'form-control '. invalid_class($name)]) }}" value="{{ $value }}">
<x-invalid-feedback :field="$name"></x-invalid-feedback>
