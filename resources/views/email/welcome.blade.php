@component('mail::message')
# Dear {{ $user->name }},

Welcome to {{ siteName() }}.

Thank you for signing up. Your registered email is {{ $user->email }}.

If you feel any difficulty while using our service, please feel free to get in touch with one of our support team.


Thanks,<br>
{{ siteName() }}
@endcomponent
