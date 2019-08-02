<?php

namespace APIRestful;

use APIRestful\Scopes\SellerScope;
use APIRestful\Transformers\SellerTransformer;


class Seller extends User
{

	//Relacionando modelos con la transformación
    public $transformer = SellerTransformer::class;

	//Funcion ejecutada al inicio del modelo
	//para ejecutar el scope
	protected static function boot()
	{
		parent::boot();

		static::addGlobalScope(new SellerScope);
	}

    //Funcion para crear la relación con el modelo Product
    public function products(){
    	return $this->hasMany(Product::class);
    }
}
