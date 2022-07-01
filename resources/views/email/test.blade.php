@component('mail::message')
# Test Email Working 😊😊

{{-- @foreach ($registerAmount as $amt )
    <p> {{$amt}} has been deduced </p>
@endforeach --}}

This is a test email.

From,<br>
{{ siteName() }}
@endcomponent
