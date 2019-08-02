<?php

namespace APIRestful\Http\Controllers\Buyer;

use APIRestful\Buyer;
use Illuminate\Http\Request;
use APIRestful\Http\Controllers\APIController;

class BuyerSellerController extends APIController
{
    
    public function index(Buyer $buyer)
    {
        $sellers = $buyer->transactions()->with('product.seller')
            ->get()
            ->pluck('product.seller')
            ->unique('id')
            ->values();

        return $this->showAll($sellers);
    }

}
