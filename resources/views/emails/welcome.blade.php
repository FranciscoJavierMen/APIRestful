Hola, bienvenido {{$user->name}}
Gracias por unirte a nosotros. 

Por favor verifica tu cuenta en el siguiente enlace:

{{route('verify', $user->verification_token)}}