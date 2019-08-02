<?php

namespace APIRestful;

use APIRestful\Transaction;
use APIRestful\Scopes\BuyerScope;
use APIRestful\Transformers\BuyerTransformer;


class Buyer extends User
{

	//Relacionando modelos con la transformación
    public $transformer = BuyerTransformer::class;

	//Funcion ejecutada al inicio del modelo
	//para ejecutar el scope
	protected static function boot()
	{
		parent::boot();

		static::addGlobalScope(new BuyerScope);
	}
    //Función para la relacion con la tabla transactions 
    public function transactions() {
    	return $this->hasMany(Transaction::class);
    }
}
