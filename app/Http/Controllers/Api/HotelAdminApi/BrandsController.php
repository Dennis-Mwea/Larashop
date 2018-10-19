<?php

namespace Larashop\Http\Controllers\Api\HotelAdminApi;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Larashop\Http\Controllers\Controller;

class BrandsController extends Controller {
    public function index() {
    	$brands = Auth::user()->brands()->get();

    	return response()->json(['data' => $brands], 200, [], JSON_NUMERIC_CHECK);
    }
}
