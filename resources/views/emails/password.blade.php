@component('mail::message')
Message de gestion auto école
Réinitialisation du mot de passe
Vous recevez cet email car nous avons reçu une demande de réinitialisation de mot de passe pour votre compte. :

votre six-digit PIN: <h4>{{$pin}}</h4>

Merci,
Gestion-Auto-Ecole<br>
{{ config('app.name') }}
@endcomponent