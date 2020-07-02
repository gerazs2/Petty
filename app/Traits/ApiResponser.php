<?php 

namespace App\Traits;

use Illuminate\Support\Collection;


trait ApiResponser
{	
	

    /*----------  Comienzan los métodos que generarán la respuesta del API  ----------*/
    
	private function successResponse($data, $code){
		return response()->json($data, $code);
	}

	protected function errorResponse($message, $code){
		return response()->json(
			[
				'data' => [],
				'message' => $message, 
				'code' => $code
			], 
			$code
		);
	}

	protected function showAll(Collection $collection, $message = 'ok', $code = 200){
		return $this->successResponse(
			[
				'data' => $collection, 
				'message' => $message, 
				'code'    => $code
			],
			$code
		);
	}

	protected function showOne(Model $instance, $message = 'ok', $code=200){
		return $this->successResponse(
			[
				'data'    => $instance, 
				'message' => $message, 
				'code'    => $code
			], 
			$code
		);
	}

	protected function success($data, $message = 'ok', $code=200){
		return $this->successResponse(
			[
				'data'    => $data, 
				'message' => $message, 
				'code'    => $code
			], 
			$code
		);
	}
}