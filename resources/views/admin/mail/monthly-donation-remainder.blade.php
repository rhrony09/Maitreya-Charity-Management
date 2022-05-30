@component('mail::message')
# Hello {{ $user->name }},

Kindly send your monthly contribution for the month of **{{ $month  }}** as soon as possible.

@component('mail::panel')
**Payment Methods:**<br>
bKash: 01680 710175<br>
Rocket: 01766 379827<br>
Nagad: 01719 590659<br>
@endcomponent

Thanks,<br>
**Team {{ config('app.name') }}**<br>
{{ route('index') }}
@endcomponent
