<?php

namespace Larashop\Http\Controllers\Api\HotelApi;

use Illuminate\Http\Request;
use Larashop\Http\Controllers\Controller;
use Larashop\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request) {
        $products = Product::where("category_id", $request->input("category_id"))->get();

        return response()->json($products, 200, [], JSON_NUMERIC_CHECK);
    }
}
