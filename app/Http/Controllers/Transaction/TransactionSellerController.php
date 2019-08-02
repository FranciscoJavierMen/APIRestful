<?php

namespace APIRestful\Http\Controllers\Transaction;

use APIRestful\Transaction;
use Illuminate\Http\Request;
use APIRestful\Http\Controllers\APIController;

class TransactionSellerController extends APIController
{
    public function index(Transaction $transaction)
    {
        $seller = $transaction->product->seller;

        return $this->showOne($seller);
    }
}
