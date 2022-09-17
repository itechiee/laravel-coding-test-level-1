@component('mail::message')
Hi,  
New event **{{ $mailInfo['eventName'] }}** is created

Thanks,<br>
{{ config('app.name') }}
@endcomponent
