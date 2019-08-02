<?php

namespace APIRestful\Http\Controllers\Seller;

use APIRestful\Seller;
use Illuminate\Http\Request;
use APIRestful\Http\Controllers\APIController;

class SellerCategoryController extends APIController
{

    public function index(Seller $seller)
    {
        $categories = $seller->products()
            ->with('categories')
            ->get()
            ->pluck('categories')
            ->collapse()
            ->unique('id')
            ->values();

        return $this->showAll($categories);
    }
}
