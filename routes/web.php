<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdministratorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|

Route::get('public/news', [PublicNewsController::class, 'index'])->name('publicnewsindex');
Route::get('public/news/view/{idEn}', [PublicNewsController::class, 'show'])->name('publicnewsshow');
Route::post('/public/news/store', [PublicNewsController::class, 'store'])->middleware('can:isGuest')->name('usernewscomment');
*/

Route::get('/', function () {
    return view('auth/login');
});

require __DIR__.'/auth.php';

Route::get('/dashboard', [HomeController::class, 'index'])->name('home');

//ADMINISTRATOR ROUTES
Route::get('/administrator', [AdministratorController::class, 'index'])->middleware('can:isAdmin')->name('administrator');

//TEACHER ROUTES

//PRINCIPAL ROUTES

//DIVISION HEAD ROUTES

//OFFICE HEAD ROUTES

//OPERATOR ROUTES

//ASSESOR ROUTES

//EXECUTIVE ROUTES
