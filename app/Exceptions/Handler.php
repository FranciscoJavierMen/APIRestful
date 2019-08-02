<?php

namespace APIRestful\Exceptions;

use Exception;
use APIRestful\Traits\ApiResponser;
use Asm89\Stack\CorsService;
use Illuminate\Database\QueryException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class Handler extends ExceptionHandler
{
    use ApiResponser;    
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        // 
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }


        /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return $this->errorResponse('No autenticado.', 401);        
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof ValidationException) {
            return $this->convertExceptionToResponse($exception, $request);
        }

        //Escepcion de modelo no encontrado
        if ($exception instanceof ModelNotFoundException) {
            $modelo = strtolower(class_basename($exception->getModel()));
            return $this->errorResponse("No existe ninguna instancia de {$modelo} con el id especificado", 404);
        }

        //Excepcion de autenticación
        if ($exception instanceof AuthenticationException) {
            return $this->unauthenticated($request, $exception);
        }

        //excepción de autorización
        if ($exception instanceof AuthorizationException) {
            return $this->errorResponse('No tiene permisos para ejecutar esta acción', 403);
        }

        //Excepción para ruta http no encontrada
        if ($exception instanceof NotFoundHttpException) {
            return $this->errorResponse('No se encontró la url especificada',404);
        }

        //Excepción de método no permitido
        if ($exception instanceof MethodNotAllowedHttpException) {
            return $this->errorResponse('El método especificado en la petición no es válido', 405);
        }

        //Controlando excepciones generaleslizadas
        if ($exception instanceof HttpException) {
            return $this->errorResponse($excepcion->getMessage(), $exception->getStatusCode());
        }
        //Condiciónal para controlar la eliminacion de datos relacionados
        if ($exception instanceof QueryException) {
            //dd($exception);
            $codigo = $exception->errorInfo[1];
            if ($codigo == 1451) {
                return $this->errorResponse('No se puede eliminar de forma permanente el recurso porque esta relacionado con algún otro.', 409);
            }
        }

        //Verificar si la api se encuentra en estado de desarrollo
        if (config('app.debug')) {
            //Retorno de excepcion predefinida
            return parent::render($request, $exception);
        }
        //Manejando errores del servidor
        return $this->errorResponse('Algo salió mal. Intente de nuevo más tarde', 500);

    }

    /**
     * Create a response object from the given validation exception.
     *
     * @param  \Illuminate\Validation\ValidationException  $e
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function convertValidationExceptionToResponse(ValidationException $e, $request)
    {
        $errors = $e->validator->errors()->getMessage();

        return $this->errorResponse($errors, 422);
    }
}
