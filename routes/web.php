<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\crudController;

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

Route::get('/', [crudController::class,'login']);
Route::get('/signup', [crudController::class,'signup']);
Route::post('/registerData',[crudController::class,'registerUser']);
Route::post('/loginData',[crudController::class,'loginUser']);
Route::get('/dashboard',[crudController::class,'dashboard']);
Route::post('/addNewTask',[crudController::class,'addNewTask']);
Route::post('/deleteTask',[crudController::class,'deleteTask']);
Route::post('/editTask',[crudController::class,'editTask']);
Route::get('/logout',[crudController::class,'logoutUser']);
