<?php

namespace App;

use App\Scopes\SellerScope;


class Seller extends User
{
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
