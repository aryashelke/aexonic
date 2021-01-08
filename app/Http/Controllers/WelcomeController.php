<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class WelcomeController extends Controller
{
    public function index(){

    	$user_list = User::get();

    	return view('index', [
    		'user_list' => $user_list,
    	]);
    }

    public function login(Request $request){

    	$user = User::where('id', $request['user_id'])->first();

    	if ($user == null) {
    		return redirect()->to('/');
    	}

    	auth()->loginUsingId($user->id);

    	return redirect()->route('home');
    }
}
