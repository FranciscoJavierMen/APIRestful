
@component('mail::message')
# Hola, bienvenido {{$user->name}}

Gracias por unirte a nosotros. 

Por favor verifica tu cuenta en el siguiente botón:

@component('mail::button', ['url' => route('verify', $user->verification_token) ])
Verificar cuenta
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
