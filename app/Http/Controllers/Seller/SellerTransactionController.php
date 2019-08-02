<?php

namespace APIRestful\Http\Controllers\Seller;

use APIRestful\Seller;
use Illuminate\Http\Request;
use APIRestful\Http\Controllers\APIController;

class SellerTransactionController extends APIController
{

    public function index(Seller $seller)
    {
        $transactions = $seller->products()
            ->wherehas('transactions')
            ->with('transactions')
            ->get()
            ->pluck('transactions')
            ->collapse();

        return $this->showAll($transactions);
    }
}
