<?php

namespace Larashop\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Larashop\Http\Controllers\Controller;

class PostController extends Controller{
    public function index() {
    	$posts = Auth::user()->posts()->get();

    	return response()->json(['data' => $posts], 200, [], JSON_NUMERIC_CHECK);
    }

    public function user() {
    	$user = Auth::user()->id;

    	return response()->json(['user' => $user], 200, [], JSON_NUMERIC_CHECK);
    }
}
