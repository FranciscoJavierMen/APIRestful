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
		if ($collection->isEmpty()) {
			return $this->successResponse(['data' => $collection], $code);
		}

		$transformer = $collection->first()->transformer;
		
		$collection = $this->filterData($collection, $transformer);
		$collection = $this->sortData($collection, $transformer);
		$collection = $this->transformData($collection, $transformer);

		return $this->successResponse($collection, $code);
	}
	//Funcion para retornar un solo dato
	protected function showOne(Model $instance, $code = 200)
	{
		$transformer = $instance->first()->transformer;
		$instance = $this->transformData($instance, $transformer);


		return $this->successResponse($instance, $code);
	}
	//Función para retornar mensajes simples
	protected function showMessage($message, $code = 200)
	{
		return $this->successResponse([
			'data' => $message
		], $code);
	}

	//Función para hacer busquedas con filtros
	protected function filterData(Collection $collection, $transformer)
	{
		foreach (request()->query() as $query => $value) {
			$attribute = $transformer::originalAttribute($query);

			if (isset($attribute, $value)) {
				$collection = $collection->where($attribute, $value);
			}
		}

		return $collection;
	}

	//Funcion para ordenar los datos
	protected function sortData(Collection $collection, $transformer)
	{
		if (request()->has('sort_by')) {
			$attribute = $transformer::originalAttribute(request()->sort_by);

			$collection = $collection->sortBy->{$attribute};
		}
		return $collection;
	}

	//Funcion para transformar los datos
	protected function transformData($data, $transformer)
	{
		$transformation = fractal($data, new $transformer);

		return $transformation->toArray();	
	}

}