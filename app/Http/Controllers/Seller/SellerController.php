<?php

namespace APIRestful\Http\Controllers\Seller;

use APIRestful\Seller;
use Illuminate\Http\Request;
use APIRestful\Http\Controllers\APIController;

class SellerController extends APIController
{
    public function index()
    {
        $sellers = Seller::has('products')->get();

        return $this->showAll($sellers);
    }

    
    public function show(Seller $seller)
    {
        //$seller = Seller::has('products')->findOrFail($id);

        return $this->showOne($seller);
    }
}
