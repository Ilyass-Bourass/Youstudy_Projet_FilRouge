<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});



Route::get('/register',[AuthController::class,'showRegister'])->name('showRegister');
Route::get('/login',[AuthController::class,'showLogin'])->name('showLogin');
Route::post('/register',[AuthController::class,'register'])->name('register');
Route::post('/login',[AuthController::class,'login'])->name('login');

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
