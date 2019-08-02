<?php

namespace APIRestful\Http\Controllers\Product;

use APIRestful\Product;
use Illuminate\Http\Request;
use APIRestful\Http\Controllers\APIController;

class ProductBuyerController extends APIController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(product $product)
    {
        $buyers = $product->transactions()
            ->with('buyer')
            ->get()
            ->pluck('buyer')
            ->unique('id')
            ->values();

        return $this->showAll($buyers);    
    }


}
