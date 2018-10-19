<?php

namespace Larashop\Http\Controllers\Api\HotelApi;

use Illuminate\Http\Request;
use Larashop\Http\Controllers\Controller;
use Larashop\Models\Brand;

class BrandsController extends Controller {
    public function index() {
    	$categories = Brand::get();

    	$response['categories'] = $categories;
    	$response['success'] = 1;

    	return response()->json(['data' => $categories], 200, [], JSON_NUMERIC_CHECK);
    }
}
