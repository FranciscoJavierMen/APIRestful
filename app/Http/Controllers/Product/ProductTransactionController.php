<?php

namespace APIRestful\Http\Controllers\Product;

use APIRestful\Product;
use Illuminate\Http\Request;
use APIRestful\Http\Controllers\APIController;

class ProductTransactionController extends APIController
{
    
    public function index(Product $product)
    {
        $transactions = $product->transactions;

        return $this->showAll($transactions);
    }
}
