<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\PartieCour;
use App\Models\Quiz;
use App\Models\Cour;
use App\Models\QuestionsQuiz;
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

    public function ChangerNiveau(Request $request)
    {
        $user = auth()->user();
        $user->niveau = $request->niveau; 
        $user->save(); // Save the changes to the database
        return redirect()->back()->with('success', 'Niveau changé avec succès vers : '.$request->niveau);  
    }

    public function dashboardAdmin(){
        $statistiques = [
            'total_cours_premium' => PartieCour::whereNotNull('url_video')->count(),
            'total_users' => User::where('role', 'user')->count(),
            'nouveaux_users' => User::where('role', 'user')->where('created_at', '>=', now()->subMonth())->count(),
            'total_nouveau_users_premium' => User::where('role', 'user_premium')->where('created_at', '>=', now()->subMonth())->count(),
            'total_users_premium' => User::where('role', 'user_premium')->count(),
            'total_parties' => PartieCour::count(),
            'total_quizzes' => Quiz::count(),
            'total_courses' => Cour::count(),
        ];
        
        return view('admin.dashboard.index',compact('statistiques'));
    }

    public function dashboardUser(){
        $nombreCoursDisponibles = PartieCour::all()->count();
        $nombreQustions = QuestionsQuiz::all()->count();
        $nombreUserPremium = User::where('role', 'user_premium')->count();
        $nombreCoursMathematiques = PartieCour::join('cours', 'partie_cours.cour_id', '=', 'cours.id')
            ->where('cours.matiere_cour', 'math')
            ->count();
        $nombreCoursPhysique = PartieCour::join('cours', 'partie_cours.cour_id', '=', 'cours.id')
            ->where('cours.matiere_cour', 'pc')
            ->count();
        $nombreCoursSvt = PartieCour::join('cours', 'partie_cours.cour_id', '=', 'cours.id')
            ->where('cours.matiere_cour', 'svt')
            ->count();
        $statistiques = [
            'nombreCoursDisponibles' => $nombreCoursDisponibles,
            'nombreQustions' => $nombreQustions,
            'nombreUserPremium' => $nombreUserPremium,
            'nombreCoursMathematiques' => $nombreCoursMathematiques,
            'nombreCoursPhysique' => $nombreCoursPhysique,
            'nombreCoursSvt' => $nombreCoursSvt,
        ];
        

        return view('user.dashboardUser',compact('statistiques'));
    }

}
