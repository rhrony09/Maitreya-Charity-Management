@component('mail::message')
# Hello {{ $user['name'] }},

Your account is created successfully. Please use the following credentials to login. Don't share your credentials with anyone.
@component('mail::panel')
Mobile No: {{ $user['contact'] }}<br>
Password: {{ $user['password'] }}
@endcomponent

@component('mail::button', ['url' => route('login')])
    Login
@endcomponent

If you did not create an account, no further action is required.

Thanks,<br>
**Team {{ config('app.name') }}**<br>
{{ route('index') }}
@endcomponent
