<?php

namespace App\Http\Controllers\Seller;

use App\Seller;
use Illuminate\Http\Request;
use App\Http\Controllers\APIController;

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
