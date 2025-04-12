<?php

use App\Http\Controllers\AuthController;
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



Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/dashboardAdmin',function(){
        return view('admin.dashboard.index');
    })->name('dashboardAdmin');

    Route::get('/users',function(){
        return view('admin.users.index');
    })->name('users');
    
    Route::get('/chapitres',function(){
        return view('admin.chapitres.index');
    })->name('chapitres');
    
    Route::get('/cours',function(){
        return view('admin.cours.index');
    })->name('cours');
    

});

Route::middleware(['auth', 'role:user'])->group(function () {

    Route::get('/dashboardUser',function(){
        return view('user.dashboardUser');
    })->name('dashboardUser');

    Route::get('/myCourses',function(){
        return view('user.myCourses');
    })->name('myCourses');
    
    Route::get('/partie_cour',function(){
        return view('user.partie_cour');
    })->name('partie_cour');
    
    Route::get('/ContenuCour',function(){
        return view('user.ContenusCour.contenuCour');
    })->name('ContenuCour');
    
    Route::get('/quizPartie',function(){
        return view('user.ContenusCour.quizPartie');
    })->name('quizPartie');
    
    Route::get('/exercicesPartie',function(){
        return view('user.ContenusCour.exercicesPartie');
    })->name('exercicesPartie');

});















