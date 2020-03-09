<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use \App\User;

class RegisterController extends Controller
{
    public function create()
    {
    	$user = new User();
    	return view('auth.register', compact('user'));
    }

    public function store(Request $request)
    {
    	$this->validate($request, [
    		'username' => 'required|unique:users|regex:/^[a-zA-Z0-9_-]+$/',
    		'password' => 'required|min:8'
    	]);

    	$user = new User();
    	$user->fill($request->all());
        $user->username = strtolower($user->username);
    	$user->password = Hash::make($request['password']);
    	$user->save();

    	Auth::login($user, true);

    	return redirect()
    		->route('main');
    }
}
