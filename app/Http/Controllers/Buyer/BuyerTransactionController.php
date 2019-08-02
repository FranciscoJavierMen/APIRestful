<?php

namespace APIRestful\Http\Controllers\Buyer;

use APIRestful\Buyer;
use Illuminate\Http\Request;
use APIRestful\Http\Controllers\APIController;

class BuyerTransactionController extends APIController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Buyer $buyer)
    {
        $transactions = $buyer->transactions;

        return $this->showAll($transactions);
    }
}
