<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminSchoolOfficialController;
use App\Http\Controllers\AdminCreditScoreController;
use App\Http\Controllers\AdminLeavePermissionController;
use App\Http\Controllers\AdminPerformanceController;
use App\Http\Controllers\AdminPromotionController;
use App\Http\Controllers\AdminSalaryIncreaseController;
use App\Http\Controllers\AdminSchoolMappingController;
use App\Http\Controllers\AdminSolutionCornerController;
use App\Http\Controllers\AdminReferenceSchoolController;
use App\Http\Controllers\AdminReferenceSubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TeacherLeavePermissionController;
use App\Http\Controllers\TeacherCreditScoreController;
use App\Http\Controllers\TeacherPerformanceController;
use App\Http\Controllers\TeacherPerformanceActivityController;
use App\Http\Controllers\TeacherPromotionController;
use App\Http\Controllers\TeacherSalaryIncreaseController;
use App\Http\Controllers\TeacherSolutionCornerController;
use App\Http\Controllers\TeacherPersonalDataController;
use App\Http\Controllers\TeacherDataAppreciationHistoryController;
use App\Http\Controllers\TeacherDataFormalEducationHistoryController;
use App\Http\Controllers\TeacherDataNonFormalEducationHistoryController;
use App\Http\Controllers\TeacherDataPositionHistoryController;
use App\Http\Controllers\TeacherDataRankHistoryController;
use App\Http\Controllers\TeacherDataSalaryIncreaseHistoryController;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\PrincipalLeavePermissionController;
use App\Http\Controllers\PrincipalPerformanceController;
use App\Http\Controllers\PrincipalPerformanceWorkBehaviorController;
use App\Http\Controllers\PrincipalPersonalDataController;
use App\Http\Controllers\PrincipalDataAppreciationHistoryController;
use App\Http\Controllers\PrincipalDataFormalEducationHistoryController;
use App\Http\Controllers\PrincipalDataNonFormalEducationHistoryController;
use App\Http\Controllers\PrincipalDataPositionHistoryController;
use App\Http\Controllers\PrincipalDataRankHistoryController;
use App\Http\Controllers\PrincipalDataSalaryIncreaseHistoryController;
use App\Http\Controllers\PrincipalSalaryIncreaseController;
use App\Http\Controllers\PrincipalSolutionCornerController;
use App\Http\Controllers\PrincipalMappingController;
use App\Http\Controllers\HeadDivisionController;
use App\Http\Controllers\DivisionHeadLeavePermissionController;
use App\Http\Controllers\DivisionHeadPerformanceController;
use App\Http\Controllers\DivisionHeadCreditScoreController;
use App\Http\Controllers\DivisionHeadSolutionCornerController;
use App\Http\Controllers\AssesorController;
use App\Http\Controllers\AssesorCreditController;
use App\Http\Controllers\AssesorPromotionController;
use App\Http\Controllers\HeadOfficeController;
use App\Http\Controllers\HeadOfficePromotionController;
use App\Http\Controllers\HeadOfficeSalaryIncreaseController;
use App\Http\Controllers\HeadOfficeSolutionCornerController;

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
//Admin Leave Permission Routes
Route::get('/administrator/leavepermission', [AdminLeavePermissionController::class, 'index'])->middleware('can:isAdmin')->name('adminlp');
Route::get('/administrator/leavepermission/destroy/{id}', [AdminLeavePermissionController::class, 'destroy'])->middleware('can:isAdmin')->name('adminlpdestroy');
//Admin Credit Score Routes
Route::get('/administrator/creditscore', [AdminCreditScoreController::class, 'index'])->middleware('can:isAdmin')->name('admincs');
Route::get('/administrator/creditscore/destroy/{id}', [AdminCreditScoreController::class, 'destroy'])->middleware('can:isAdmin')->name('admincsdestroy');
//Admin Promotion Routes
Route::get('/administrator/promotion', [AdminPromotionController::class, 'index'])->middleware('can:isAdmin')->name('adminp');
Route::get('/administrator/promotion/destroy/{id}', [AdminPromotionController::class, 'destroy'])->middleware('can:isAdmin')->name('adminpdestroy');
//Admin Salary Increase Routes
Route::get('/administrator/salaryincrease', [AdminSalaryIncreaseController::class, 'index'])->middleware('can:isAdmin')->name('adminsi');
Route::get('/administrator/salaryincrease/destroy/{id}', [AdminSalaryIncreaseController::class, 'destroy'])->middleware('can:isAdmin')->name('adminsidestroy');
//Admin Solution Corner Routes
Route::get('/administrator/solutioncorner', [AdminSolutionCornerController::class, 'index'])->middleware('can:isAdmin')->name('adminsc');
Route::get('/administrator/solutioncorner/destroy/{id}', [AdminSolutionCornerController::class, 'destroy'])->middleware('can:isAdmin')->name('adminscdestroy');
//ADMIN RFERENCE ROUTES
//Admin Reference School Official Routes
Route::get('/administrator/reference/schoolofficial', [AdminSchoolOfficialController::class, 'index'])->middleware('can:isAdmin')->name('adminschoff');
Route::get('/administrator/reference/schoolofficial/create', [AdminSchoolOfficialController::class, 'create'])->middleware('can:isAdmin')->name('adminschoffcreate');
Route::post('/administrator/reference/schoolofficial/store', [AdminSchoolOfficialController::class, 'store'])->middleware('can:isAdmin')->name('adminschoffstore');
//Admin Reference Work Unit Routes
Route::get('/administrator/reference/workunit', [AdminReferenceSchoolController::class, 'index'])->middleware('can:isAdmin')->name('adminrefwo');
Route::get('/administrator/reference/workunit/create', [AdminReferenceSchoolController::class, 'create'])->middleware('can:isAdmin')->name('adminrefwocreate');
Route::post('/administrator/reference/workunit/store', [AdminReferenceSchoolController::class, 'store'])->middleware('can:isAdmin')->name('adminrefwostore');
Route::get('/administrator/reference/workunit/destroy/{id}', [AdminReferenceSchoolController::class, 'destroy'])->middleware('can:isAdmin')->name('adminrefwodestroy');
//Admin Reference Subject Routes
Route::get('/administrator/reference/subject', [AdminReferenceSubjectController::class, 'index'])->middleware('can:isAdmin')->name('adminrefs');
Route::get('/administrator/reference/subject/create', [AdminReferenceSubjectController::class, 'create'])->middleware('can:isAdmin')->name('adminrefscreate');
Route::post('/administrator/reference/subject/store', [AdminReferenceSubjectController::class, 'store'])->middleware('can:isAdmin')->name('adminrefsstore');
Route::get('/administrator/reference/subject/destroy/{id}', [AdminReferenceSubjectController::class, 'destroy'])->middleware('can:isAdmin')->name('adminrefsdestroy');

//TEACHER ROUTES
Route::get('/teacher', [TeacherController::class, 'index'])->middleware('can:isTeacher')->name('teacher');
//Teacher Leave Permission Routes
Route::get('/teacher/leavepermission', [TeacherLeavePermissionController::class, 'index'])->middleware('can:isTeacher')->name('teacherlp');
Route::get('/teacher/leavepermission/create', [TeacherLeavePermissionController::class, 'create'])->middleware('can:isTeacher')->name('teacherlpcreate');
Route::post('/teacher/leavepermission/store', [TeacherLeavePermissionController::class, 'store'])->middleware('can:isTeacher')->name('teacherlpstore');
Route::get('/teacher/leavepermission/show/{id}', [TeacherLeavePermissionController::class, 'show'])->middleware('can:isTeacher')->name('teacherlpshow');
Route::get('/teacher/leavepermission/pdf/{id}', [TeacherLeavePermissionController::class, 'pdf'])->middleware('can:isTeacher')->name('teacherlppdf');
//Teacher Performance Routes
Route::get('/teacher/performance', [TeacherPerformanceController::class, 'index'])->middleware('can:isTeacher')->name('teacherpt');
Route::get('/teacher/performance/create', [TeacherPerformanceController::class, 'create'])->middleware('can:isTeacher')->name('teacherptcreate');
Route::post('/teacher/performance/store', [TeacherPerformanceController::class, 'store'])->middleware('can:isTeacher')->name('teacherptstore');
Route::get('/teacher/performance/show/{id}', [TeacherPerformanceController::class, 'show'])->middleware('can:isTeacher')->name('teacherptshow');
Route::post('/teacher/performance/lock/{id}', [TeacherPerformanceController::class, 'lock'])->middleware('can:isTeacher')->name('teacherptlock');
Route::get('/teacher/performance/destroy/{id}', [TeacherPerformanceController::class, 'destroy'])->middleware('can:isTeacher')->name('teacherptdestroy');
//Teacher Performance Files Routes
Route::get('/teacher/performance/show/planning/{id}', [TeacherPerformanceController::class, 'showplanning'])->middleware('can:isTeacher')->name('teacherptshowplan');
Route::get('/teacher/performance/show/realization/{id}', [TeacherPerformanceController::class, 'showrealization'])->middleware('can:isTeacher')->name('teacherptshowreal');
Route::get('/teacher/performance/show/dp3/{id}', [TeacherPerformanceController::class, 'showdp3'])->middleware('can:isTeacher')->name('teacherptshowdp3');

//Teacher Performance Activity Routes
Route::get('/teacher/performance/activity/create/pbt/{id}', [TeacherPerformanceActivityController::class, 'createpbt'])->middleware('can:isTeacher')->name('teacherptapbt');
Route::post('/teacher/performance/activity/create/pbt/store/{id}', [TeacherPerformanceActivityController::class, 'storepbt'])->middleware('can:isTeacher')->name('teacherptastorepbt');
Route::get('/teacher/performance/activity/create/pkb/{id}', [TeacherPerformanceActivityController::class, 'createpkb'])->middleware('can:isTeacher')->name('teacherptapkb');
Route::post('/teacher/performance/activity/create/store/{id}', [TeacherPerformanceActivityController::class, 'store'])->middleware('can:isTeacher')->name('teacherptastoreactivity');
Route::get('/teacher/performance/activity/create/up/{id}', [TeacherPerformanceActivityController::class, 'createup'])->middleware('can:isTeacher')->name('teacherptaup');
Route::get('/teacher/performance/activity/show/{id}/{idpt}', [TeacherPerformanceActivityController::class, 'show'])->middleware('can:isTeacher')->name('teacherptactshow');
Route::post('/teacher/performance/activity/store/{id}/{idpt}', [TeacherPerformanceActivityController::class, 'uploadproof'])->middleware('can:isTeacher')->name('teacherptproof');
Route::get('/teacher/performance/activity/delete/{id}', [TeacherPerformanceActivityController::class, 'delete'])->middleware('can:isTeacher')->name('teacherptactdelete');

//Teacher Credit Score Routes
Route::get('/teacher/creditscore', [TeacherCreditScoreController::class, 'index'])->middleware('can:isTeacher')->name('teachercs');
Route::get('/teacher/creditscore/create', [TeacherCreditScoreController::class, 'create'])->middleware('can:isTeacher')->name('teachercscreate');
Route::post('/teacher/creditscore/store', [TeacherCreditScoreController::class, 'store'])->middleware('can:isTeacher')->name('teachercsstore');
Route::get('/teacher/creditscore/show/{id}', [TeacherCreditScoreController::class, 'show'])->middleware('can:isTeacher')->name('teachercsshow');
Route::get('/teacher/creditscore/edit/{id}/{idc}', [TeacherCreditScoreController::class, 'edit'])->middleware('can:isTeacher')->name('teachercsedit');
Route::post('/teacher/creditscore/update/{id}/{idc}', [TeacherCreditScoreController::class, 'update'])->middleware('can:isTeacher')->name('teachercsupdate');
Route::get('/teacher/creditscore/create/oldactivity/{id}', [TeacherCreditScoreController::class, 'createold'])->middleware('can:isTeacher')->name('teachercscrold');
Route::post('/teacher/creditscore/create/oldactivity/store/{id}', [TeacherCreditScoreController::class, 'storeold'])->middleware('can:isTeacher')->name('teachercscrstoreold');
Route::post('/teacher/creditscore/lock/{id}', [TeacherCreditScoreController::class, 'lock'])->middleware('can:isTeacher')->name('teachercslock');
Route::get('/teacher/creditscore/pdf/{id}', [TeacherCreditScoreController::class, 'pdf'])->middleware('can:isTeacher')->name('teachercspdf');

//Teacher Promotion Routes
Route::get('/teacher/promotion', [TeacherPromotionController::class, 'index'])->middleware('can:isTeacher')->name('teacherpm');
Route::get('/teacher/promotion/create', [TeacherPromotionController::class, 'create'])->middleware('can:isTeacher')->name('teacherpmcreate');
Route::post('/teacher/promotion/store', [TeacherPromotionController::class, 'store'])->middleware('can:isTeacher')->name('teacherpmstore');
Route::get('/teacher/promotion/show/{id}', [TeacherPromotionController::class, 'show'])->middleware('can:isTeacher')->name('teacherpmshow');
Route::get('/teacher/promotion/score/edit/{id}/{pmid}', [TeacherPromotionController::class, 'edit'])->middleware('can:isTeacher')->name('teacherpmedit');
Route::get('/teacher/promotion/upload/{id}/{pmid}', [TeacherPromotionController::class, 'upload'])->middleware('can:isTeacher')->name('teacherpmupload');
Route::post('/teacher/promotion/update/{id}/{pmid}', [TeacherPromotionController::class, 'update'])->middleware('can:isTeacher')->name('teacherpmupdate');
Route::post('/teacher/promotion/uploadfile/{id}/{pmid}', [TeacherPromotionController::class, 'uploadfile'])->middleware('can:isTeacher')->name('teacherpmuploadfile');
Route::post('/teacher/promotion/lock/{id}', [TeacherPromotionController::class, 'lock'])->middleware('can:isTeacher')->name('teacherpmlock');
Route::get('/teacher/promotion/create/oldactivity/{id}', [TeacherPromotionController::class, 'oldactivity'])->middleware('can:isTeacher')->name('teacherpmoldact');
Route::post('/teacher/promotion/storeold/{id}', [TeacherPromotionController::class, 'storeold'])->middleware('can:isTeacher')->name('teacherpmstoreold');
Route::get('/teacher/promotion/score/destroy/{id}', [TeacherPromotionController::class, 'destroy'])->middleware('can:isTeacher')->name('teacherpmdestroy');
Route::get('/teacher/promotion/lock/{id}', [TeacherPromotionController::class, 'lock'])->middleware('can:isTeacher')->name('teacherpmlock');
Route::get('/teacher/promotion/pdf/{id}', [TeacherPromotionController::class, 'pdf'])->middleware('can:isTeacher')->name('teacherpmpdf');

//Teacher Salary Increase Routes
Route::get('/teacher/salaryincrease', [TeacherSalaryIncreaseController::class, 'index'])->middleware('can:isTeacher')->name('teachersi');
Route::get('/teacher/salaryincrease/create', [TeacherSalaryIncreaseController::class, 'create'])->middleware('can:isTeacher')->name('teachersicreate');
Route::post('/teacher/salaryincrease/store', [TeacherSalaryIncreaseController::class, 'store'])->middleware('can:isTeacher')->name('teachersistore');
Route::get('/teacher/salaryincrease/show/{id}', [TeacherSalaryIncreaseController::class, 'show'])->middleware('can:isTeacher')->name('teachersishow');
Route::get('/teacher/salaryincrease/pdf/{id}', [TeacherSalaryIncreaseController::class, 'pdf'])->middleware('can:isTeacher')->name('teachersipdf');
Route::get('/teacher/salaryincrease/upload/{id}/{siid}', [TeacherSalaryIncreaseController::class, 'upload'])->middleware('can:isTeacher')->name('teachersiupload');
Route::post('/teacher/salaryincrease/uploadfile/{id}/{siid}', [TeacherSalaryIncreaseController::class, 'uploadfile'])->middleware('can:isTeacher')->name('teachersiuploadfile');
Route::post('/teacher/salaryincrease/lock/{id}', [TeacherSalaryIncreaseController::class, 'lock'])->middleware('can:isTeacher')->name('teachersilock');
//Teacher Solution Corner Routes
Route::get('/teacher/solutioncorner', [TeacherSolutionCornerController::class, 'index'])->middleware('can:isTeacher')->name('teachersc');
Route::get('/teacher/solutioncorner/create', [TeacherSolutionCornerController::class, 'create'])->middleware('can:isTeacher')->name('teachersccreate');
Route::get('/teacher/solutioncorner/show/{id}', [TeacherSolutionCornerController::class, 'show'])->middleware('can:isTeacher')->name('teacherscshow');
Route::post('/teacher/solutioncorner/store', [TeacherSolutionCornerController::class, 'store'])->middleware('can:isTeacher')->name('teacherscstore');
Route::post('/teacher/solutioncorner/feedback/{id}', [TeacherSolutionCornerController::class, 'feedback'])->middleware('can:isTeacher')->name('teacherscfeedback');

//Teacher Personal Data Routes
Route::get('/teacher/personaldata', [TeacherPersonalDataController::class, 'index'])->middleware('can:isTeacher')->name('teacherpd');
//Teacher Data History Routes
//Formal Education History Routes
Route::get('/teacher/personaldata/formaleducation/create', [TeacherDataFormalEducationHistoryController::class, 'create'])->middleware('can:isTeacher')->name('teacherpdfehcr');
Route::post('/teacher/personaldata/formaleducation/store', [TeacherDataFormalEducationHistoryController::class, 'store'])->middleware('can:isTeacher')->name('teacherpdfehstore');
Route::get('/teacher/personaldata/formaleducation/destroy/{id}', [TeacherDataFormalEducationHistoryController::class, 'destroy'])->middleware('can:isTeacher')->name('teacherpdfehds');
//Non-Formal Education History Routes
Route::get('/teacher/personaldata/nonformaleducation/create', [TeacherDataNonFormalEducationHistoryController::class, 'create'])->middleware('can:isTeacher')->name('teacherpdnfehcr');
Route::post('/teacher/personaldata/nonformaleducation/store', [TeacherDataNonFormalEducationHistoryController::class, 'store'])->middleware('can:isTeacher')->name('teacherpdnfehstore');
Route::get('/teacher/personaldata/nonformaleducation/destroy/{id}', [TeacherDataNonFormalEducationHistoryController::class, 'destroy'])->middleware('can:isTeacher')->name('teacherpdnfehds');
//Rank History Routes
Route::get('/teacher/personaldata/rank/create', [TeacherDataRankHistoryController::class, 'create'])->middleware('can:isTeacher')->name('teacherpdrhcr');
Route::post('/teacher/personaldata/rank/store', [TeacherDataRankHistoryController::class, 'store'])->middleware('can:isTeacher')->name('teacherpdrhstore');
Route::get('/teacher/personaldata/rank/destroy/{id}', [TeacherDataRankHistoryController::class, 'destroy'])->middleware('can:isTeacher')->name('teacherpdrhds');
//Position History Routes
Route::get('/teacher/personaldata/positionhistory/create', [TeacherDataPositionHistoryController::class, 'create'])->middleware('can:isTeacher')->name('teacherpdphcr');
Route::post('/teacher/personaldata/positionhistory/store', [TeacherDataPositionHistoryController::class, 'store'])->middleware('can:isTeacher')->name('teacherpdphstore');
Route::get('/teacher/personaldata/positionhistory/destroy/{id}', [TeacherDataPositionHistoryController::class, 'destroy'])->middleware('can:isTeacher')->name('teacherpdphds');
//Salary Increase History Routes
Route::get('/teacher/personaldata/salaryincreasehistory/create', [TeacherDataSalaryIncreaseHistoryController::class, 'create'])->middleware('can:isTeacher')->name('teacherpdsihcr');
Route::post('/teacher/personaldata/salaryincreasehistory/store', [TeacherDataSalaryIncreaseHistoryController::class, 'store'])->middleware('can:isTeacher')->name('teacherpdsihstore');
Route::get('/teacher/personaldata/salaryincreasehistory/destroy/{id}', [TeacherDataSalaryIncreaseHistoryController::class, 'destroy'])->middleware('can:isTeacher')->name('teacherpdsihds');
//Appreciation History Routes
Route::get('/teacher/personaldata/appreciationhistory/create', [TeacherDataAppreciationHistoryController::class, 'create'])->middleware('can:isTeacher')->name('teacherpdahcr');
Route::post('/teacher/personaldata/appreciationhistory/store', [TeacherDataAppreciationHistoryController::class, 'store'])->middleware('can:isTeacher')->name('teacherpdahstore');
Route::get('/teacher/personaldata/appreciationhistory/destroy/{id}', [TeacherDataAppreciationHistoryController::class, 'destroy'])->middleware('can:isTeacher')->name('teacherpdahds');

//PRINCIPAL ROUTES
Route::get('/principal', [PrincipalController::class, 'index'])->middleware('can:isPrincipal')->name('principal');
//Principal Leave Permission Routes
Route::get('/principal/leavepermission', [PrincipalLeavePermissionController::class, 'index'])->middleware('can:isPrincipal')->name('principallp');
Route::get('/principal/leavepermission/show/{id}', [PrincipalLeavePermissionController::class, 'show'])->middleware('can:isPrincipal')->name('principallpshow');
Route::post('/principal/leavepermission/approve/{id}', [PrincipalLeavePermissionController::class, 'approve'])->middleware('can:isPrincipal')->name('principallpapprove');
Route::post('/principal/leavepermission/reject/{id}', [PrincipalLeavePermissionController::class, 'reject'])->middleware('can:isPrincipal')->name('principallpreject');
//Principal Performance Target Routes
Route::get('/principal/performance', [PrincipalPerformanceController::class, 'index'])->middleware('can:isPrincipal')->name('principalpt');
Route::get('/principal/performance/show/{id}', [PrincipalPerformanceController::class, 'show'])->middleware('can:isPrincipal')->name('principalptshow');
Route::post('/principal/performance/done/{id}', [PrincipalPerformanceController::class, 'done'])->middleware('can:isPrincipal')->name('principalptdone');
Route::get('/principal/performance/score/{id}/{idpt}', [PrincipalPerformanceController::class, 'score'])->middleware('can:isPrincipal')->name('principalptscore');
Route::post('/principal/performance/scoreact/{id}/{idpt}', [PrincipalPerformanceController::class, 'scoreact'])->middleware('can:isPrincipal')->name('principalptscoreact');
//Principal Performance Target Work Behavior Routes
Route::post('/principal/performance/workbehavior/create/{id}', [PrincipalPerformanceWorkBehaviorController::class, 'create'])->middleware('can:isPrincipal')->name('principalptwbcreate');
Route::get('/principal/performance/workbehavior/show/{id}/{idpt}', [PrincipalPerformanceWorkBehaviorController::class, 'show'])->middleware('can:isPrincipal')->name('principalptwbshow');
Route::post('/principal/performance/workbehavior/score/{id}/{idpt}', [PrincipalPerformanceWorkBehaviorController::class, 'score'])->middleware('can:isPrincipal')->name('principalptwbscore');
//Principal Salary Increase Routes
Route::get('/principal/salaryincrease', [PrincipalSalaryIncreaseController::class, 'index'])->middleware('can:isPrincipal')->name('principalsi');
Route::get('/principal/salaryincrease/create', [PrincipalSalaryIncreaseController::class, 'create'])->middleware('can:isPrincipal')->name('principalsicreate');
Route::post('/principal/salaryincrease/store', [PrincipalSalaryIncreaseController::class, 'store'])->middleware('can:isPrincipal')->name('principalsistore');
Route::get('/principal/salaryincrease/show/{id}', [PrincipalSalaryIncreaseController::class, 'show'])->middleware('can:isPrincipal')->name('principalsishow');
Route::get('/principal/salaryincrease/pdf/{id}', [PrincipalSalaryIncreaseController::class, 'pdf'])->middleware('can:isPrincipal')->name('principalsipdf');
Route::get('/principal/salaryincrease/upload/{id}/{siid}', [PrincipalSalaryIncreaseController::class, 'upload'])->middleware('can:isPrincipal')->name('principalsiupload');
Route::post('/principal/salaryincrease/uploadfile/{id}/{siid}', [PrincipalSalaryIncreaseController::class, 'uploadfile'])->middleware('can:isPrincipal')->name('principalsiuploadfile');
Route::post('/principal/salaryincrease/lock/{id}', [PrincipalSalaryIncreaseController::class, 'lock'])->middleware('can:isPrincipal')->name('principalsilock');
//Principal Solution Corner Routes
Route::get('/principal/solutioncorner', [PrincipalSolutionCornerController::class, 'index'])->middleware('can:isPrincipal')->name('principalsc');
Route::get('/principal/solutioncorner/create', [PrincipalSolutionCornerController::class, 'create'])->middleware('can:isPrincipal')->name('principalsccreate');
Route::get('/principal/solutioncorner/show/{id}', [PrincipalSolutionCornerController::class, 'show'])->middleware('can:isPrincipal')->name('principalscshow');
Route::post('/principal/solutioncorner/store', [PrincipalSolutionCornerController::class, 'store'])->middleware('can:isPrincipal')->name('principalscstore');
Route::post('/principal/solutioncorner/feedback/{id}', [PrincipalSolutionCornerController::class, 'feedback'])->middleware('can:isPrincipal')->name('principalscfeedback');
//Principal Mapping Routes
Route::get('/principal/mapping', [PrincipalMappingController::class, 'index'])->middleware('can:isPrincipal')->name('principalmp');
Route::get('/principal/mapping/create', [PrincipalMappingController::class, 'create'])->middleware('can:isPrincipal')->name('principalmpcreate');
Route::get('/principal/mapping/show/{id}', [PrincipalMappingController::class, 'show'])->middleware('can:isPrincipal')->name('principalmpshow');
Route::post('/principal/mapping/store', [PrincipalMappingController::class, 'store'])->middleware('can:isPrincipal')->name('principalmpstore');
Route::get('/principal/mapping/subject/create/{id}', [PrincipalMappingController::class, 'createsubject'])->middleware('can:isPrincipal')->name('principalmpcreatesub');
Route::post('/principal/mapping/subject/store/{id}', [PrincipalMappingController::class, 'storesubject'])->middleware('can:isPrincipal')->name('principalmpstoresub');
Route::get('/principal/mapping/subject/show/{id}/{ids}', [PrincipalMappingController::class, 'showsubject'])->middleware('can:isPrincipal')->name('principalmpshowsub');
Route::get('/principal/mapping/subject/teacher/create/{id}/{ids}', [PrincipalMappingController::class, 'createteacher'])->middleware('can:isPrincipal')->name('principalmpcreatetc');
Route::post('/principal/mapping/subject/teacher/store/{id}/{ids}', [PrincipalMappingController::class, 'storeteacher'])->middleware('can:isPrincipal')->name('principalmpstoretc');
Route::post('/principal/mapping/finish/{id}', [PrincipalMappingController::class, 'finish'])->middleware('can:isPrincipal')->name('principalmpfinish');
Route::get('/principal/mapping/pdf/{id}', [PrincipalMappingController::class, 'pdf'])->middleware('can:isPrincipal')->name('principalmppdf');

//Principal Personal Data Routes
Route::get('/principal/personaldata', [PrincipalPersonalDataController::class, 'index'])->middleware('can:isPrincipal')->name('principalpd');
//Principal Data History Routes
//Formal Education History Routes
Route::get('/principal/personaldata/formaleducation/create', [PrincipalDataFormalEducationHistoryController::class, 'create'])->middleware('can:isPrincipal')->name('principalpdfehcr');
Route::post('/principal/personaldata/formaleducation/store', [PrincipalDataFormalEducationHistoryController::class, 'store'])->middleware('can:isPrincipal')->name('principalpdfehstore');
Route::get('/principal/personaldata/formaleducation/destroy/{id}', [PrincipalDataFormalEducationHistoryController::class, 'destroy'])->middleware('can:isPrincipal')->name('principalpdfehds');
//Non-Formal Education History Routes
Route::get('/principal/personaldata/nonformaleducation/create', [PrincipalDataNonFormalEducationHistoryController::class, 'create'])->middleware('can:isPrincipal')->name('principalpdnfehcr');
Route::post('/principal/personaldata/nonformaleducation/store', [PrincipalDataNonFormalEducationHistoryController::class, 'store'])->middleware('can:isPrincipal')->name('principalpdnfehstore');
Route::get('/principal/personaldata/nonformaleducation/destroy/{id}', [PrincipalDataNonFormalEducationHistoryController::class, 'destroy'])->middleware('can:isPrincipal')->name('principalpdnfehds');
//Rank History Routes
Route::get('/principal/personaldata/rank/create', [PrincipalDataRankHistoryController::class, 'create'])->middleware('can:isPrincipal')->name('principalpdrhcr');
Route::post('/principal/personaldata/rank/store', [PrincipalDataRankHistoryController::class, 'store'])->middleware('can:isPrincipal')->name('principalpdrhstore');
Route::get('/principal/personaldata/rank/destroy/{id}', [PrincipalDataRankHistoryController::class, 'destroy'])->middleware('can:isPrincipal')->name('principalpdrhds');
//Position History Routes
Route::get('/principal/personaldata/positionhistory/create', [PrincipalDataPositionHistoryController::class, 'create'])->middleware('can:isPrincipal')->name('principalpdphcr');
Route::post('/principal/personaldata/positionhistory/store', [PrincipalDataPositionHistoryController::class, 'store'])->middleware('can:isPrincipal')->name('principalpdphstore');
Route::get('/principal/personaldata/positionhistory/destroy/{id}', [PrincipalDataPositionHistoryController::class, 'destroy'])->middleware('can:isPrincipal')->name('principalpdphds');
//Salary Increase History Routes
Route::get('/principal/personaldata/salaryincreasehistory/create', [PrincipalDataSalaryIncreaseHistoryController::class, 'create'])->middleware('can:isPrincipal')->name('principalpdsihcr');
Route::post('/principal/personaldata/salaryincreasehistory/store', [PrincipalDataSalaryIncreaseHistoryController::class, 'store'])->middleware('can:isPrincipal')->name('principalpdsihstore');
Route::get('/principal/personaldata/salaryincreasehistory/destroy/{id}', [PrincipalDataSalaryIncreaseHistoryController::class, 'destroy'])->middleware('can:isPrincipal')->name('principalpdsihds');
//Appreciation History Routes
Route::get('/principal/personaldata/appreciationhistory/create', [PrincipalDataAppreciationHistoryController::class, 'create'])->middleware('can:isPrincipal')->name('principalpdahcr');
Route::post('/principal/personaldata/appreciationhistory/store', [PrincipalDataAppreciationHistoryController::class, 'store'])->middleware('can:isPrincipal')->name('principalpdahstore');
Route::get('/principal/personaldata/appreciationhistory/destroy/{id}', [PrincipalDataAppreciationHistoryController::class, 'destroy'])->middleware('can:isPrincipal')->name('principalpdahds');

//DIVISION HEAD ROUTES
Route::get('/divisionhead', [HeadDivisionController::class, 'index'])->middleware('can:isDivisionHead')->name('divisionhead');
//Division Head Leave Permission Routes
Route::get('/divisionhead/leavepermission', [DivisionHeadLeavePermissionController::class, 'index'])->middleware('can:isDivisionHead')->name('divheadlp');
Route::get('/divisionhead/leavepermission/show/{id}', [DivisionHeadLeavePermissionController::class, 'show'])->middleware('can:isDivisionHead')->name('divheadlpshow');
Route::post('/divisionhead/leavepermission/approve/{id}', [DivisionHeadLeavePermissionController::class, 'approve'])->middleware('can:isDivisionHead')->name('divheadlpapprove');
Route::post('/divisionhead/leavepermission/reject/{id}', [DivisionHeadLeavePermissionController::class, 'reject'])->middleware('can:isDivisionHead')->name('divheadlpreject');
//Division Head Performance Routes
Route::get('/divisionhead/performance', [DivisionHeadPerformanceController::class, 'index'])->middleware('can:isDivisionHead')->name('divheadpt');
Route::get('/divisionhead/performance/show/{id}', [DivisionHeadPerformanceController::class, 'show'])->middleware('can:isDivisionHead')->name('divheadptshow');
Route::post('/divisionhead/performance/done/{id}', [DivisionHeadPerformanceController::class, 'done'])->middleware('can:isDivisionHead')->name('divheadptdone');
//Division Head Credit Score Routes
Route::get('/divisionhead/creditscore', [DivisionHeadCreditScoreController::class, 'index'])->middleware('can:isDivisionHead')->name('divheadcr');
Route::get('/divisionhead/creditscore/show/{id}', [DivisionHeadCreditScoreController::class, 'show'])->middleware('can:isDivisionHead')->name('divheadcrshow');
Route::post('/divisionhead/creditscore/lock/{id}', [DivisionHeadCreditScoreController::class, 'lock'])->middleware('can:isDivisionHead')->name('divheadcrlock');
//Division Head Solution Corner Routes
Route::get('/divisionhead/solutioncorner', [DivisionHeadSolutionCornerController::class, 'index'])->middleware('can:isDivisionHead')->name('divheadsc');
Route::get('/divisionhead/solutioncorner/show/{id}', [DivisionHeadSolutionCornerController::class, 'show'])->middleware('can:isDivisionHead')->name('divheadscshow');
Route::post('/divisionhead/solutioncorner/done/{id}', [DivisionHeadSolutionCornerController::class, 'update'])->middleware('can:isDivisionHead')->name('divheadscupdate');

//OFFICE HEAD ROUTES
Route::get('/officehead', [HeadOfficeController::class, 'index'])->middleware('can:isOfficeHead')->name('officehead');
//Head Office Promotion
Route::get('/officehead/promotion', [HeadOfficePromotionController::class, 'index'])->middleware('can:isOfficeHead')->name('officeheadpr');
Route::get('/officehead/promotion/show/{id}', [HeadOfficePromotionController::class, 'show'])->middleware('can:isOfficeHead')->name('officeheadprshow');
Route::post('/officehead/promotion/approve/{id}', [HeadOfficePromotionController::class, 'approve'])->middleware('can:isOfficeHead')->name('officeheadprapprove');
//Head Office Salary Increase
Route::get('/officehead/salaryincrease', [HeadOfficeSalaryIncreaseController::class, 'index'])->middleware('can:isOfficeHead')->name('officeheadsi');
Route::get('/officehead/salaryincrease/show/{id}', [HeadOfficeSalaryIncreaseController::class, 'show'])->middleware('can:isOfficeHead')->name('officeheadsishow');
Route::post('/officehead/salaryincrease/approve/{id}', [HeadOfficeSalaryIncreaseController::class, 'approve'])->middleware('can:isOfficeHead')->name('officeheadsiapprove');
Route::post('/officehead/salaryincrease/reject/{id}', [HeadOfficeSalaryIncreaseController::class, 'reject'])->middleware('can:isOfficeHead')->name('officeheadsireject');
//Head Office Salary Increase
Route::get('/officehead/solutioncorner', [HeadOfficeSolutionCornerController::class, 'index'])->middleware('can:isOfficeHead')->name('officeheadsc');
Route::get('/officehead/solutioncorner/show/{id}', [HeadOfficeSolutionCornerController::class, 'show'])->middleware('can:isOfficeHead')->name('officeheadscshow');
Route::post('/officehead/solutioncorner/done/{id}', [HeadOfficeSolutionCornerController::class, 'update'])->middleware('can:isOfficeHead')->name('officeheadscupdate');

//OPERATOR ROUTES

//ASSESOR ROUTES
Route::get('/assesor', [AssesorController::class, 'index'])->middleware('can:isAssesor')->name('assesor');
//Assesor Credit Controller
Route::get('/assesor/creditscore', [AssesorCreditController::class, 'index'])->middleware('can:isAssesor')->name('assesorcr');
Route::get('/assesor/creditscore/show/{id}', [AssesorCreditController::class, 'show'])->middleware('can:isAssesor')->name('assesorcrshow');
Route::get('/assesor/creditscore/score/{id}/{idc}', [AssesorCreditController::class, 'score'])->middleware('can:isAssesor')->name('assesorcrscore');
Route::post('/assesor/creditscore/scorestore/{id}', [AssesorCreditController::class, 'scorestore'])->middleware('can:isAssesor')->name('assesorcrscorestore');
Route::get('/assesor/creditscore/reject/{idperformancescore}/{idassesmentscore}/{idassesment}', [AssesorCreditController::class, 'reject'])->middleware('can:isAssesor')->name('assesorcrreject');
Route::post('/assesor/creditscore/rejectstore/{idperformancescore}/{idassesmentscore}/{idassesment}', [AssesorCreditController::class, 'rejectstore'])->middleware('can:isAssesor')->name('assesorcrrejectstore');
Route::post('/assesor/creditscore/scoring/{id}/{idc}', [AssesorCreditController::class, 'scoring'])->middleware('can:isAssesor')->name('assesorcrscoring');
Route::post('/assesor/creditscore/lock/{id}', [AssesorCreditController::class, 'lock'])->middleware('can:isAssesor')->name('assesorcrlock');
//Assesor Promotion Controller
Route::get('/assesor/promotion', [AssesorPromotionController::class, 'index'])->middleware('can:isAssesor')->name('assesorpr');
Route::get('/assesor/promotion/show/{id}', [AssesorPromotionController::class, 'show'])->middleware('can:isAssesor')->name('assesorprshow');
Route::post('/assesor/promotion/rejected/{id}/{reason}', [AssesorPromotionController::class, 'rejected'])->middleware('can:isAssesor')->name('assesorprreject');
Route::post('/assesor/promotion/accepted/{id}', [AssesorPromotionController::class, 'accepted'])->middleware('can:isAssesor')->name('assesorpracc');
//EXECUTIVE ROUTES
