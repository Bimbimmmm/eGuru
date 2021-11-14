<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminSchoolOfficialController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TeacherLeavePermissionController;
use App\Http\Controllers\TeacherCreditScoreController;
use App\Http\Controllers\TeacherPerformanceController;
use App\Http\Controllers\TeacherPromotionController;
use App\Http\Controllers\TeacherSalaryIncreaseController;
use App\Http\Controllers\TeacherSolutionCornerController;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\PrincipalLeavePermissionController;
use App\Http\Controllers\HeadDivisionController;
use App\Http\Controllers\DivisionHeadLeavePermissionController;

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
//ADMIN RFERENCE ROUTES
//Admin Reference School Official Routes
Route::get('/administrator/reference/schoolofficial', [AdminSchoolOfficialController::class, 'index'])->middleware('can:isAdmin')->name('adminschoff');
Route::get('/administrator/reference/schoolofficial/create', [AdminSchoolOfficialController::class, 'create'])->middleware('can:isAdmin')->name('adminschoffcreate');
Route::post('/administrator/reference/schoolofficial/store', [AdminSchoolOfficialController::class, 'store'])->middleware('can:isAdmin')->name('adminschoffstore');


//TEACHER ROUTES
Route::get('/teacher', [TeacherController::class, 'index'])->middleware('can:isTeacher')->name('teacher');
//Teacher Leave Permission Routes
Route::get('/teacher/leavepermission', [TeacherLeavePermissionController::class, 'index'])->middleware('can:isTeacher')->name('teacherlp');
Route::get('/teacher/leavepermission/create', [TeacherLeavePermissionController::class, 'create'])->middleware('can:isTeacher')->name('teacherlpcreate');
Route::post('/teacher/leavepermission/store', [TeacherLeavePermissionController::class, 'store'])->middleware('can:isTeacher')->name('teacherlpstore');
Route::get('/teacher/leavepermission/show/{id}', [TeacherLeavePermissionController::class, 'show'])->middleware('can:isTeacher')->name('teacherlpshow');


//Teacher Performance Routes
Route::get('/teacher/performance', [TeacherPerformanceController::class, 'index'])->middleware('can:isTeacher')->name('teacherpr');

//Teacher Credit Score Routes
Route::get('/teacher/creditscore', [TeacherCreditScoreController::class, 'index'])->middleware('can:isTeacher')->name('teachercs');

//Teacher Promotion Routes
Route::get('/teacher/promotion', [TeacherPromotionController::class, 'index'])->middleware('can:isTeacher')->name('teacherpm');

//Teacher Salary Increase Routes
Route::get('/teacher/salaryincrease', [TeacherSalaryIncreaseController::class, 'index'])->middleware('can:isTeacher')->name('teachersi');

//Teacher Solution Corner Routes
Route::get('/teacher/solutioncorner', [TeacherSolutionCornerController::class, 'index'])->middleware('can:isTeacher')->name('teachersc');


//PRINCIPAL ROUTES
Route::get('/principal', [PrincipalController::class, 'index'])->middleware('can:isPrincipal')->name('principal');
//Principal Leave Permission
Route::get('/principal/leavepermission', [PrincipalLeavePermissionController::class, 'index'])->middleware('can:isPrincipal')->name('principallp');
Route::get('/principal/leavepermission/show/{id}', [PrincipalLeavePermissionController::class, 'show'])->middleware('can:isPrincipal')->name('principallpshow');
Route::post('/principal/leavepermission/approve/{id}', [PrincipalLeavePermissionController::class, 'approve'])->middleware('can:isPrincipal')->name('principallpapprove');
Route::post('/principal/leavepermission/reject/{id}', [PrincipalLeavePermissionController::class, 'reject'])->middleware('can:isPrincipal')->name('principallpreject');

//DIVISION HEAD ROUTES
Route::get('/divisionhead', [HeadDivisionController::class, 'index'])->middleware('can:isDivisionHead')->name('divisionhead');
//Division Head Leave Permission
Route::get('/divisionhead/leavepermission', [DivisionHeadLeavePermissionController::class, 'index'])->middleware('can:isDivisionHead')->name('divheadlp');
Route::get('/divisionhead/leavepermission/show/{id}', [DivisionHeadLeavePermissionController::class, 'show'])->middleware('can:isDivisionHead')->name('divheadlpshow');
Route::post('/divisionhead/leavepermission/approve/{id}', [DivisionHeadLeavePermissionController::class, 'approve'])->middleware('can:isDivisionHead')->name('divheadlpapprove');
Route::post('/divisionhead/leavepermission/reject/{id}', [DivisionHeadLeavePermissionController::class, 'reject'])->middleware('can:isDivisionHead')->name('divheadlpreject');


//OFFICE HEAD ROUTES

//OPERATOR ROUTES

//ASSESOR ROUTES

//EXECUTIVE ROUTES
