<?php

namespace APIRestful\Traits;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

trait ApiResponser
{
	//Funcion para retornar el mensaje de correcto
	private function successResponse($data, $code)
	{
		return response()->json($data, $code);
	}
	//Función para retornar el mensaje de error
	protected function errorResponse($message, $code)
	{
		return response()->json([
			'error' => $message, 'code' => $code
		], $code);
	}
	//Función para retornar todos los datos
	protected function showAll(Collection $collection, $code = 200)
	{
		return $this->successResponse([
			'data' => $collection
		], $code);
	}
	//Funcion para retornar un solo dato
	protected function showOne(Model $instance, $code = 200)
	{
		return $this->successResponse([
			'data' => $instance
		], $code);
	}
	//Función para retornar mensajes simples
	protected function showMessage($message, $code = 200)
	{
		return $this->successResponse([
			'data' => $message
		], $code);
	}
}