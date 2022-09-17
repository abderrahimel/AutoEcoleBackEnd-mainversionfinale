@component('mail::message')
Bonjour !
<br>
Veuillez clique sur le bouton ci-dessous pour verifier votre address <br>
<a href="{{$url}}" style="display: flex;align-items:center;justify-content:center;background-color: rgb(45, 55, 72);border-style: solid;border: none;color: white;padding: 15px 32px;text-align: center;text-decoration: none;display: inline-block;margin: 4px 2px;cursor: pointer;
">Verify Email Address</a>

<br>
Si vous n'avez pas cree de compte, vous pouvez ignorer ce message.<br>
Cordialement,<br>
Gestion-Auto-Ecole.
Si vous ne parvenez pas à cliquer sur le bouton "Vérifier l'adresse e-mail", copiez et collez l'URL ci-dessous dans votre navigateur Web :<a href="{{$url}}">{{$url}}</a>
<br>
{{ config('app.name') }}
@endcomponent