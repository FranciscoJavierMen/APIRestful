<?php

namespace APIRestful\Http\Controllers\Seller;

use APIRestful\Seller;
use Illuminate\Http\Request;
use APIRestful\Http\Controllers\APIController;

class SellerBuyerController extends APIController
{
    
    public function index(Seller $seller)
    {
        $buyers = $seller->products()
            ->whereHas('transactions')
            ->with('transactions.buyer')
            ->get()
            ->pluck('transactions')
            ->collapse()
            ->pluck('buyer')
            ->unique()
            ->values();

        return $this->showAll($buyers);
    }
}
