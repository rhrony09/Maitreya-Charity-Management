@component('mail::message')
# Hello Admin,

A new user has registered on the site. Please review the details below.

@component('mail::panel')
Name: {{ $user['name'] }}<br>
Mobile No: {{ $user['contact'] }}
@endcomponent

@component('mail::button', ['url' => route('users')])
    View User
@endcomponent

Thanks,<br>
**Team {{ config('app.name') }}**<br>
{{ route('index') }}
@endcomponent
