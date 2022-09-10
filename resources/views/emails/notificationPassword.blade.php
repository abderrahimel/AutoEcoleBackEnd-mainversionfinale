@component('mail::message')
# Reset Password

Your password changed 
<p> You made a request to reset your password. Please discard if this wasn't you.</p>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
