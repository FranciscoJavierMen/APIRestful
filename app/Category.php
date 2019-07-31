<?php

namespace App;

use App\Product;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	//Indicando que el campo es para una fecha
    protected $dates = ['deleted_at'];
    
    protected $fillable = [
    	'name',
    	'description',
    ];

    //Función para realizar la relacion con la tabla products
    public function products() {
    	return $this->belongsToMany(Product::class);
    }
}
