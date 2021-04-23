@component('mail::message')
# Verification PIN Received

You have received a verification PIN to complete the signup!

Your PIN: <b>{{$pin}}</b>
Verification Link: {{$url}}

<br>
Thanks,<br>
{{ config('app.name') }}
@endcomponent