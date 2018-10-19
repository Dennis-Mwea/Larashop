<?php

namespace Larashop\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use Larashop\Http\Controllers\Controller;
use Larashop\Models\User;
use Laravel\Passport\Client;

class RegisterController extends Controller {
	use IssueTokenTrait;

	private $client;

	public function __construct() {
		$this->client = Client::findOrFail(1);
	}

	public function register(Request $request) {
		$this->validate($request, [
			'name' => 'required',
			'email' => 'required|email|unique:users,email',
			'password' => 'required|min:6',
		]);

		$user = User::create([
			'name' => request('name'),
			'email' => request('email'),
			'password' => bcrypt(request('password')),
		]);

		return $this->issueToken($request, 'password');
	}
}
