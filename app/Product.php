<?php

namespace App;

use App\Seller;
use App\Category;
use App\Transaction;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	//Constantes para el estado del producto
	const PRODUCTO_DISPONIBLE = 'disponible';
	const PRODUCTO_NO_DISPONIBLE = 'no disponible';

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

    //Función para crear relacion con el modelo Category
    public function categories() {
        return $this->belongsToMany(Category::class);
    }

    //función para la relación con el modelo Seller
    public function seller() {
        return $this->belongsTo(Seller::class);
    }

    //Función para la relación con el modelo Transaction
    public function transactions() {
        return $this->hasMany(Transaction::class);
    }
}
