<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AssesmentCredit;
use App\Models\AssesmentCreditScore;
use App\Models\ReferenceAssesmentCreditScoreActivity;
use App\Models\ReferenceEducationCreditScore;
use App\Models\PerformanceTarget;
use App\Models\PerformanceTargetScore;
use App\Models\ReferenceActivityCreditScore;
use Validator;
use Alert;

class AssesorCreditController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas=AssesmentCredit::where(['is_ready' => TRUE, 'is_finished' => FALSE])->get();
        return view('assesor/creditscore/index', compact('datas'));
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
      $assesment=AssesmentCredit::where('id', $id)->first();
      $datas=AssesmentCreditScore::where('assesment_credit_id' , $id)->orderBy('reference_assesment_credit_score_activity_id', 'asc')->get();
      return view('assesor/creditscore/show', compact('assesment', 'datas'));
    }

    public function score($id, $idc)
    {
      $check=AssesmentCredit::where('id', $idc)->first();
      $data=AssesmentCreditScore::where('id' , $id)->first();
      $activities=PerformanceTargetScore::where(['id' => $check->performance_target_id, 'is_deleted' => FALSE])->get();
      return view('assesor/creditscore/score', compact('data', 'activities'));
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
