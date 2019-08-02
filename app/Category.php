<?php

namespace APIRestful;

use APIRestful\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    
	//Indicando que el campo es para una fecha
    protected $dates = ['deleted_at'];
    
    protected $fillable = [
    	'name',
    	'description',
    ];

    //Oculta la tabla pivote
    protected $hidden = [
        'pivot'
    ];

    //Función para realizar la relacion con la tabla products
    public function products() {
    	return $this->belongsToMany(Product::class);
    }
}
