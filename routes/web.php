<?php

use App\Http\Controllers\AdminController;
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
Route::get('/', [HomeController::class,'home']);
Route::get('/admin', [AdminController::class,'admin']);
Route::get('/signin',[UserController::class,'signin']);
Route::get('/signup',[UserController::class,'signup']);
Route::post('/login',[UserController::class,'login']);
Route::post('/register',[UserController::class,'register']);