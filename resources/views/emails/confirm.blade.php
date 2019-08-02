
@component('mail::message')
# Hola {{$user->name}}

Has cambiado tu correo electrónico exitosamente.

Por favor verificalo en el siguiente botón:

@component('mail::button', ['url' => route('verify', $user->verification_token) ])
Confirmar cuenta
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
