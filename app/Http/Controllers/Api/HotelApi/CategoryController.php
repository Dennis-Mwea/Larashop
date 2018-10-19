<?php

namespace Larashop\Http\Controllers\Api\HotelApi;

use Illuminate\Http\Request;
use Larashop\Http\Controllers\Controller;
use Larashop\Models\Brand;
use Larashop\Models\Category;

class CategoryController extends Controller {
    public function index() {
        $categories = Brand::with('categories')->get();
        $category = Category::where('brand_id', $id)->get();
    	return response()->json(['data' => $categories]);
    }
}
