<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){

        // Récupérer tous les utilisateurs
        $users =User::where('role', 'user')->get();
        $usersPremium=User::where('role', 'user_premium')->get();
       // dd($usersPremium);
       return view('admin.users.index',compact('users','usersPremium'));
    }
}
