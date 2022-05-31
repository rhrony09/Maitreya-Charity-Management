@component('mail::message')
# Hello {{ $data['name'] }},

Your monthly contribution for the month of **{{ $data['month']  }}** is received successfully.

@component('mail::panel')
**Month:** {{ $data['month'] }}<br>
**Amount:** {{ $data['amount'] }} BDT<br>
**Payment Method:** {{ $data['payment_method'] }}
@endcomponent

Thanks,<br>
**Team {{ config('app.name') }}**<br>
{{ route('index') }}
@endcomponent
