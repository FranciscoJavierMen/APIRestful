<?php

namespace App\Http\Controllers\Seller;

use App\Seller;
use Illuminate\Http\Request;
use App\Http\Controllers\APIController;

class SellerController extends APIController
{
    public function index()
    {
        $sellers = Seller::has('products')->get();

        return response()->json([
            'data' => $sellers
        ], 200);
    }

    
    public function show($id)
    {
        $seller = Seller::has('products')->findOrFail($id);

        return response()->json([
            'data' => $seller
        ]);
    }
}
