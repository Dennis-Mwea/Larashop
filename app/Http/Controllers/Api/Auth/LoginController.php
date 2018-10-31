<?php

namespace Larashop\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Larashop\Http\Controllers\Controller;
use Laravel\Passport\Client;

class LoginController extends Controller{
    use IssueTokenTrait;

    private $client;

    public function __construct() {
    	$this->client = Client::find(1);
    }

    public function login(Request $request) {
    	$this->validate($request, [
    		'username' => 'required',
    		'password' => 'required'
    	]);

    	return $this->issueToken($request, 'password');
    }

    public function refresh(Request $request) {
    	$this->validate($request, [
    		'refresh_token' => 'required'
    	]);

    	return $this->issueToken($request, 'refresh_token');
    }

    public function logout(Request $request){

    	$accessToken = Auth::user()->token();

    	DB::table('oauth_refresh_tokens')
    		->where('access_token_id', $accessToken->id)
    		->update(['revoked' => true]);

    	$accessToken->revoke();

    	return response()->json([], 204);

    }

    public function user() {
        $userDetails = Auth::user()->userDetails()->get();

        return response()->json(['user' => $userDetails]);
    }
}
