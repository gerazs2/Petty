<?php 

namespace App\Traits;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\LengthAwarePaginator;


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
		
		if($collection->isEmpty()) { 
			return $this->successResponse(
			[
				'data' => $collection, 
				'message' => $message, 
				'code'    => $code
			],
			$code
			);
		}
		$collection = $this->filterData($collection);
		$collection = $this->sortData($collection);
		$collection = $this->paginate($collection);
		return $this->successResponse(
		[
			'data' => $collection, 
			'message' => $message, 
			'code'    => $code
		],
		$code
		);
		
	}

	protected function showOne( $instance, $message = 'ok', $code=200){
		return $this->successResponse(
			[
				'data'    =>  array($instance) , 
				'message' => $message, 
				'code'    => $code
			], 
			$code
		);
	}

	protected function success($data, $message = 'ok', $code=200){
		return $this->successResponse(
			[
				'data'    => array($data), 
				'message' => $message, 
				'code'    => $code
			], 
			$code
		);
	}

	protected function paginate(Collection $collection){
		$rules = [
			'per_page' => 'integer|min:5|max:50'
		];
		Validator::validate(request()->all(), $rules);
		$page = LengthAwarePaginator::resolveCurrentPage();
		$perPage = 15;
		if(request()->has('per_page')){
			$perPage = (int) request()->per_page;
		}
		$results = $collection->slice(($page-1)*$perPage, $perPage)->values();
		$paginated = new LengthAwarePaginator($results,$collection->count(), $perPage,$page, [
			'path' => LengthAwarePaginator::resolveCurrentPath(),
		]);
		$paginated->appends(request()->all());
		return $paginated;
	}

	protected function sortData(Collection $collection){
		if(request()->has('sort_by')){
			$attribute = request()->sort_by;
			$collection = $collection->sortBy->$attribute;
		}
		return $collection;
	}

	protected function filterData(Collection $collection){
		foreach (request()->query() as $query => $value) {
			//echo json_encode($query);
			if(isset($value) && ($query!='sort_by' && $query!='per_page' && $query!='page')){
				$collection = $collection->where($query, $value);
			}
		}
		return $collection;
	}
}