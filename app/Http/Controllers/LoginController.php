<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\User;

class LoginController extends Controller
{
    public function index()
    {
    	$user = new User();
    	return view('auth.login', compact('user'));
    }

    public function login(Request $request)
    {
    	$this->validate($request, [
    		'username' => 'required',
    		'password' => 'required',
    	]);

    	$username = strtolower($request['username']);
    	$password = $request['password'];
    	$remember = $request['remember'] === 'yes';

    	if (Auth::attempt(['username' => $username, 'password' => $password], $remember)) {
    		return redirect()
    			->route('main');
    	}

    	$user = new User();
    	$user->username = $username;
    	$failed = 'Пользователь не найден';

    	return view('auth.login', compact('user', 'failed'));
    }

    public function logout()
    {
    	Auth::logout();
    	return redirect()
			->route('main');
    }
}
