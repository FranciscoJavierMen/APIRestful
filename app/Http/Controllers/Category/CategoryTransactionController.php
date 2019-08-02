<?php

namespace APIRestful\Http\Controllers\Category;

use APIRestful\Category;
use Illuminate\Http\Request;
use APIRestful\Http\Controllers\APIController;

class CategoryTransactionController extends APIController
{

    public function index(Category $category)
    {
        $transactions = $category->products()
            ->whereHas('transactions')
            ->with('transactions')
            ->get()
            ->pluck('transactions')
            ->collapse();

        return $this->showAll($transactions);        
    }
}
