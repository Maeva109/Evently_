<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [HomeController::class,'home'])->middleware('guest')->name('home');
Route::get('/signup',[UserController::class,'signin']);
Route::get('/signin',[UserController::class,'signup'])->middleware('guest')->name('signin');
Route::post('/login',[UserController::class,'login'])->middleware('guest');
Route::get('/logout',[UserController::class,'logout']);
Route::post('/register',[UserController::class,'register']);
Route::post('/sendmessage',[ContactController::class,'sendmessage']);
Route::get('/contact', [ContactController::class,'showForm']);
Route::middleware(['auth','admin'])->group(function(){
    Route::get('/admin', [AdminController::class,'admin'])->middleware('auth');
});
