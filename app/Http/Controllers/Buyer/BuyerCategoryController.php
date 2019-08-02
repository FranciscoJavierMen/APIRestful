<?php

namespace APIRestful\Http\Controllers\Buyer;

use APIRestful\Buyer;
use Illuminate\Http\Request;
use APIRestful\Http\Controllers\APIController;

class BuyerCategoryController extends APIController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Buyer $buyer)
    {
        $categories = $buyer->transactions()->with('product.categories')
            ->get()
            ->pluck('product.categories')
            ->collapse()
            ->values();


        return $this->showAll($categories);
    }
}
