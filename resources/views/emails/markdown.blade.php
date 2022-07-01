@component('mail::message')
# HI  LOGIN ALERT

TOO MANY ATTEMPTS hit

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
