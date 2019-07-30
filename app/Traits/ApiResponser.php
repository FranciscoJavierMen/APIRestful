<?php

namespace App\Traits

trait ApiResponse
{
	private function successResponce($data, $code)
	{
		return response()->json($data, $code);
	}

	protected function errorResponse($message, $code)
	{
		return responde()->json([
			'error' => $message, 'code' => $code
		], $code);
	}

	protected function showAll(Collection $collection, $code = 200)
	{
		return $this->successResponse([
			'data' => $collection
		], $code);
	}

	protected showone(Model $instance, $code = 200)
	{
		return $this->successResponse([
			'data' => $instance
		], $code);
	}
}