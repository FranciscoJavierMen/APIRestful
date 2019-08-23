<?php

namespace APIRestful\Http\Controllers\Category;

use APIRestful\Category;
use Illuminate\Http\Request;
use APIRestful\Http\Controllers\APIController;

class CategoryProductController extends APIController
{
    public function __construct()
    {
        $this->middleware('client.credentials')->only(['index']);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category)
    {
        $products = $category->products;

        return $this->showAll($products);
    }

}
