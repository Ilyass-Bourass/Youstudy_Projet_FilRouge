<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showRegister(){
        return view('register');
    }
    public function showLogin(){
        return view('login');
    }
    public function register(){
        return 'register';
    }
    public function login(){
        return 'login';
    }
}
