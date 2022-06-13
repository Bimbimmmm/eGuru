<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\LeavePermissions;
use App\Models\NewPerformanceTarget;
use App\Models\NewAssesmentCredit;
use App\Models\NewPromotion;
use App\Models\SalaryIncrease;
use App\Models\SolutionCorner;
use App\Models\PrincipalMapping;

class AdministratorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userall=User::where('is_deleted', FALSE)->count();
        $leavepermissionall=LeavePermissions::where('is_deleted', FALSE)->count();
        $performancetargetall=NewPerformanceTarget::where('is_deleted', FALSE)->count();
        $creditscoreall=NewAssesmentCredit::where('is_deleted', FALSE)->count();
        $promotionall=NewPromotion::where('is_deleted', FALSE)->count();
        $salaryincreaseall=SalaryIncrease::where('is_deleted', FALSE)->count();
        $solutioncornerall=SolutionCorner::where('is_deleted', FALSE)->count();
        $mappingall=PrincipalMapping::where('is_deleted', FALSE)->count();
        return view('administrator/index', compact(
          'leavepermissionall', 'performancetargetall', 'creditscoreall',
          'promotionall', 'salaryincreaseall', 'solutioncornerall', 'userall', 'mappingall'
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
