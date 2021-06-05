<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LogoutController extends Controller
{
    // public function __construct(){
    //     $this->middleware('guest', ['except' => ['logout', 'getLogout']]);
    // }

    public function store(){

        auth()->logout();
        
        return redirect()->route('home');
    }
}
