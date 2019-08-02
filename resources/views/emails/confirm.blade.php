Hola {{$user->name}}
Has cambiado tu correo electrónico exitosamente. 

Por favor verificalo en el siguiente enlace:

{{route('verify', $user->verification_token)}}