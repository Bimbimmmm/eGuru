<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TeacherLeavePermissionController;

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

Route::get('getCity/{id}', function ($id) {
    $cities = App\Models\Cities::where('province_code',$id)->get();
    return response()->json($cities);
});

Route::get('getDistrict/{id}', function ($id) {
    $districts = App\Models\Districts::where('city_code',$id)->get();
    return response()->json($districts);
});

Route::get('getVillage/{id}', function ($id) {
    $villages = App\Models\Villages::where('district_code',$id)->get();
    return response()->json($villages);
});

//ADMINISTRATOR ROUTES
Route::get('/administrator', [AdministratorController::class, 'index'])->middleware('can:isAdmin')->name('administrator');
//Admin User Routes
Route::get('/administrator/users', [AdminUserController::class, 'index'])->middleware('can:isAdmin')->name('adminuserindex');
Route::get('/administrator/users/create', [AdminUserController::class, 'create'])->middleware('can:isAdmin')->name('adminusercreate');
Route::post('/administrator/users/store', [AdminUserController::class, 'store'])->middleware('can:isAdmin')->name('adminuserstore');

//TEACHER ROUTES
Route::get('/teacher', [TeacherController::class, 'index'])->middleware('can:isTeacher')->name('teacher');

Route::get('/teacher/leavepermission', [TeacherLeavePermissionController::class, 'index'])->middleware('can:isTeacher')->name('teacherlp');
Route::get('/teacher/leavepermission/create', [TeacherLeavePermissionController::class, 'create'])->middleware('can:isTeacher')->name('teacherlpcreate');


//PRINCIPAL ROUTES

//DIVISION HEAD ROUTES

//OFFICE HEAD ROUTES

//OPERATOR ROUTES

//ASSESOR ROUTES

//EXECUTIVE ROUTES
