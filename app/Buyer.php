<?php

namespace App;

use App\Transaction;
use App\Scopes\BuyerScope;


class Buyer extends User
{
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
