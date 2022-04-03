<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\LeavePermissions;
use App\Models\PerformanceTarget;
use App\Models\AssesmentCredit;
use App\Models\Promotion;
use App\Models\SalaryIncrease;
use App\Models\SolutionCorner;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $is_integration=User::where(['id' => $user_id, 'personal_data_id' => NULL])->count();
        $leavepermission=LeavePermissions::where('user_id', $user_id)->count();
        $leavepermissionall=LeavePermissions::all()->count();
        $performancetarget=PerformanceTarget::where(['user_id' => $user_id, 'is_deleted' => FALSE])->count();
        $performancetargetall=PerformanceTarget::all()->count();
        $creditscore=AssesmentCredit::where(['user_id' => $user_id, 'is_deleted' => FALSE])->count();
        $creditscoreall=AssesmentCredit::all()->count();
        $promotion=Promotion::where(['user_id' => $user_id, 'is_deleted' => FALSE])->count();
        $promotionall=Promotion::all()->count();
        $salaryincrease=SalaryIncrease::where(['user_id' => $user_id, 'is_deleted' => FALSE])->count();
        $salaryincreaseall=SalaryIncrease::all()->count();
        $solutioncorner=SolutionCorner::where(['user_id' => $user_id, 'is_deleted' => FALSE])->count();
        $solutioncornerall=SolutionCorner::all()->count();
        return view('teacher/index', compact(
        'is_integration', 'leavepermission', 'leavepermissionall',
        'performancetarget', 'performancetargetall', 'creditscore',
        'creditscoreall', 'promotion', 'promotionall',
        'salaryincrease', 'salaryincreaseall', 'solutioncorner', 'solutioncornerall'
      ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
