<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	//Constantes para el estado del producto
	const PRODUCTO_DISPONIBLE = 'disponible';
	const PRODUCTO_NO_DISPONIBLE = 'no disponible'

    protected $fillable = [
    	'name',
    	'description',
    	'quantity',
    	'status',
    	'image',
    	'seller_id',
    ];

    //Función para verificar el estado del producto
    public function estaDisponible() {
    	return $this->status == Product::PRODUCTO_DISPONIBLE;
    }
}
