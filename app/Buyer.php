<?php

namespace App;


class Buyer extends User
{
    //Función para la relacion con la tabla transactions 
    public function transactions() {
    	return $this->hasMany(Transaction::class);
    }
}
