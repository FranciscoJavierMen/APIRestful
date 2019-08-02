<?php

namespace APIRestful\Http\Controllers\Transaction;

use APIRestful\Transaction;
use Illuminate\Http\Request;
use APIRestful\Http\Controllers\APIController;

class TransactionCategoryController extends APIController
{
    public function index(Transaction $transaction)
    {
        $categories = $transaction->product->categories;

        return $this->showAll($categories);
    }
}
