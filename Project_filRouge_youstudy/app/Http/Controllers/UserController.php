<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){

        
        $users =User::where('role', 'user')->get();
        $usersPremium=User::where('role', 'user_premium')->get();
       // dd($usersPremium);
       return view('admin.users.index',compact('users','usersPremium'));
    }

    public function destroy($id){
        
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->back()->with('success', 'Utilisateur '.$user->name.' supprimé avec succès');
    }
    
    public function activerPremium($id){
        
        $user = User::findOrFail($id);
        $user->role = 'user_premium';
        $user->save();
        return redirect()->back()->with('success', 'Compte premium de '.$user->name .' activé avec succès');
    }

    public function desactiverPremium($id){
        
        $user = User::findOrFail($id);
        $user->role = 'user';
        $user->save();
        return redirect()->back()->with('success', 'Compte premium de ' . $user->name . '  désactivé avec succès');
    }

}
