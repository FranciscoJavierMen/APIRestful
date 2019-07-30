<?php

namespace App;


class Seller extends User
{
    //Funcion para crear la relación con el modelo Product
    public function products(){
    	return $this->hasMany(Product::class);
    }
}
