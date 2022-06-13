<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewPerformanceTarget;
use App\Models\NewPerformanceTargetScore;
use App\Models\NewPerformanceTargetWorkBehaviour;
use App\Models\ReferenceWorkBehavior;
use App\Models\ReferenceActivityCreditScore;
use App\Models\PositionMapping;
use Validator;
use Alert;

class HeadOfficePerformanceController extends Controller
{
  public function index()
  {
      $datas=NewPerformanceTarget::where(['is_official_approve' => TRUE, 'is_deleted' => FALSE])->get();
      return view('head_office/performance/index', compact('datas'));
  }

  public function show($id)
  {
      $data=NewPerformanceTarget::where('id', $id)->first();
      $count=NewPerformanceTargetScore::where('new_performance_target_id', $id)->count();
      $activities=NewPerformanceTargetScore::where(['new_performance_target_id' => $id, 'is_deleted' => FALSE])->orderBy('created_at', 'ASC')->get();
      $check=NewPerformanceTargetWorkBehaviour::where(['new_performance_target_id' => $id, 'is_deleted' => FALSE])->count();
      $workbehaviours=NewPerformanceTargetWorkBehaviour::where(['new_performance_target_id' => $id, 'is_deleted' => FALSE])->orderBy('updated_at', 'DESC')->get();
      return view('head_office/performance/show', compact('data', 'count', 'activities', 'check', 'workbehaviours'));
  }
}
