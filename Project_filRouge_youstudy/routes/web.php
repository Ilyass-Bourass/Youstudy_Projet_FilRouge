<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourController;
use App\Http\Controllers\PartieCourController;
use App\Http\Controllers\QuestionsQuizController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\UserController;
use App\Models\PartieCour;
use App\Models\User;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('home');
});

Route::get('/register', [AuthController::class, 'showRegister'])->name('showRegister');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/login',[AuthController::class,'showLogin'])->name('showLogin');
Route::post('/login',[AuthController::class,'login'])->name('login');

Route::get('/logout',[AuthController::class,'logout'])->name('logout');



Route::get('/verification', [AuthController::class, 'showVerification'])->name('verification.notice');
Route::post('/verification/verify', [AuthController::class, 'verify'])->name('verification.verify');

Route::get('/complete-registration', [AuthController::class, 'showCompleteRegistration'])->name('complete.registration');
Route::post('/complete-registration', [AuthController::class, 'completeRegistration']);
Route::post('/traitementQuiz', [QuizController::class, 'traitementQuiz'])->name('traitementQuiz');





Route::middleware(['auth', 'role:admin'])->group(function () {

    

    Route::get('/dashboardAdmin/statistiques',[UserController::class,'dashboardAdmin'])->name('dashboardAdmin');
    Route::get('/dashboardAdmin/users',[UserController::class,'index'])->name('users'); 

 
    Route::get('/dashboardAdmin/chapitres',[PartieCourController::class,'index'])->name('chapitres');
    Route::get('/dashboardAdmin/quiz',[QuizController::class,'index'])->name('quiz');
    
    Route::get('/dashboardAdmin/cours',[CourController::class,'index'])->name('cours');
    // Crud des cours dans le dashboard admin
    Route::post('/dashboardAdmin/cours/Create_cour',[CourController::class,'create'])->name('Create_cour');
    Route::post('/dashboardAdmin/cours/deleteCour/{id}',[CourController::class,'destroy'])->name('delete_cour');
    Route::get('/dashboardAdmin/cours/editCour/{id}',[CourController::class,'edit'])->name('edit_cour');
    Route::put('/dashboardAdmin/cours/updateCour/{id}', [CourController::class, 'update'])->name('update_cour');

    // Ajout d' une nouvelle partie de cour
    Route::post('/addChapitre',[PartieCourController::class,'create'])->name('addChapitre');

    // Gestions des users

    Route::delete('/deleteUser/{id}',[UserController::class,'destroy'])->name('deleteUser');
    Route::post('/activerPremium/{id}',[UserController::class,'activerPremium'])->name('activerPremium');
    Route::post('/desactiverPremium/{id}',[UserController::class,'desactiverPremium'])->name('desactiverPremium');

    Route::get('/showPartieFetch/{id}',[PartieCourController::class,'showPartieFetch'])->name('showPartieFetch');
    Route::put('/update-partie-cour', [PartieCourController::class, 'update'])->name('updatePartieCour');
    Route::delete('/deletePartieCour/{id}',[PartieCourController::class,'destroy'])->name('deletePartieCour');

    Route::get('/showQuestionsfetch/{id}',[QuestionsQuizController::class,'showQuestionsfetch'])->name('showQuestionsfetch');
    Route::put('/update-questions-quiz', [QuestionsQuizController::class, 'update'])->name('updateQuestionsQuiz');
});



Route::middleware(['auth', 'role:user,user_premium'])->group(function () {

    Route::get('/dashboardUser',[UserController::class,'dashboardUser'])->name('dashboardUser');

    Route::get('/myCourses',function(){
        return view('user.myCourses');
    })->name('myCourses');
    
    Route::get('/partie_cour',[PartieCourController::class,'showPartiesCour'])->name('partie_cour');

    Route::get('/ChangerNiveau',[UserController::class,'ChangerNiveau'])->name('ChangerNiveau');
    

    // affichaege de contenu du cour
    Route::get('/ContenuCour/{id}',[PartieCourController::class,'show'])->name('ContenuCour');
    Route::get('/quizPartie/{id}',[QuizController::class, 'show'])->name('quizPartie');
    Route::get('/exercicesPartie/{id}',[PartieCourController::class,'showExercice'])->name('exercicesPartie');
   
    Route::post('/updateCour/{id}',[CourController::class,'update'])->name('update_cour');

});















