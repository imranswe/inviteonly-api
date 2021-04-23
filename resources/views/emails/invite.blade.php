@component('mail::message')
# Invitation Received

You have received an invitation for signup!

@component('mail::button', ['url' => $url])
Signup
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent