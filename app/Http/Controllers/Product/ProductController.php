<?php

namespace App\Http\Controllers\Product;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\APIController;

class ProductController extends APIController
{
    //Función para mostrar todas las instancias de Product
    public function index()
    {
        $products = Product::all();

        return $this->showAll($products);
    }
    //Funcion para retornar la instancia
    public function show(Product $product)
    {
        return $this->showOne($product);
    }
}
