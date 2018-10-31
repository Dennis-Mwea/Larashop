<?php

namespace Larashop\Http\Controllers\Api\HotelApi;

use Illuminate\Http\Request;
use Larashop\Http\Controllers\Controller;
use Larashop\Models\Brand;
use Larashop\Models\Category;
use Larashop\Models\Product;

class CategoryController extends Controller {
    public function index() {
        // $category = Category::where('brand_id', request('id'))->get();
        $category = Category::all();

        $response['categories'] = $category;
        $response['success'] = 1;
        
    	return response()->json(['data' => $category], 200, [], JSON_NUMERIC_CHECK);
    }
}
