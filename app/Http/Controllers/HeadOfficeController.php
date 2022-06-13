<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\LeavePermissions;
use App\Models\NewPerformanceTarget;
use App\Models\NewAssesmentCredit;
use App\Models\NewPromotion;
use App\Models\SalaryIncrease;

class HeadOfficeController extends Controller
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
      $leavepermission=LeavePermissions::where(['is_direct_supervisor_approve' => TRUE, 'is_official_approve' => TRUE])->count();
      $performance=NewPerformanceTarget::where(['is_official_approve' => TRUE, 'is_deleted' => FALSE])->count();
      $performance_all=NewPerformanceTarget::where('is_deleted', FALSE)->count();
      $creditscore=NewAssesmentCredit::where(['is_official_approve' => TRUE, 'is_deleted' => FALSE])->count();
      $creditscore_all=NewAssesmentCredit::where('is_deleted', FALSE)->count();
      $promotion=NewPromotion::where(['is_locked' => TRUE, 'is_assesed' => TRUE, 'is_finish' => FALSE, 'is_rejected' => FALSE, 'is_deleted' => FALSE])->count();
      $promotion_all=NewPromotion::where('is_deleted', FALSE)->count();
      $salaryincrease=SalaryIncrease::where(['is_locked' => TRUE, 'is_finish' => FALSE, 'is_rejected' => FALSE, 'is_deleted' => FALSE])->count();
      $salaryincrease_all=SalaryIncrease::where(['is_deleted' => FALSE])->count();
      return view('head_office/index', compact('salaryincrease', 'salaryincrease_all', 'is_integration', 'leavepermission', 'performance', 'performance_all', 'creditscore', 'creditscore_all', 'promotion', 'promotion_all'));
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
