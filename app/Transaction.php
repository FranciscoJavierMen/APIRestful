<?php

namespace APIRestful;

use APIRestful\Buyer;
use APIRestful\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use APIRestful\Transformers\TransactionTransformer;

class Transaction extends Model
{

    use SoftDeletes;

    //Relacionando modelos con la transformación
    public $transformer = TransactionTransformer::class;

    //Indicando que el campo es para una fecha
    protected $dates = ['deleted_at'];
    
    protected $fillable = [
    	'quantity',
    	'buyer_id',
    	'product_id',
    ];

    //Función para crear la relación con el modelo Buyer
    public function buyer(){
    	return $this->belongsTo(Buyer::class);
    }

    //Función para crear la relación con el modelo Product
    public function product() {
    	return $this->belongsTo(Product::class);
    }
}
