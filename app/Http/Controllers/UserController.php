<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class UserController extends Controller
{
    public function updateStatus(Request $request){
    	User::where('id', $request['user_id'])->update(['status' => $request['status']]);
    	return redirect()->route('home');
    }
}
