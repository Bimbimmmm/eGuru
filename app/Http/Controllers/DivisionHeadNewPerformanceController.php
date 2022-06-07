<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\NewPerformanceTarget;
use App\Models\NewPerformanceTargetScore;
use App\Models\NewPerformanceTargetWorkBehaviour;
use App\Models\ReferenceWorkBehavior;
use App\Models\ReferenceActivityCreditScore;
use App\Models\PositionMapping;
use Validator;
use Alert;

class DivisionHeadNewPerformanceController extends Controller
{
  public function index()
  {
      $user_id = auth()->user()->id;
      $position_mapping=PositionMapping::where(['supervisor_id' => $user_id, 'is_active' => TRUE])->first();
      $datas=NewPerformanceTarget::where(['position_mapping_id' => $position_mapping->id, 'is_deleted' => FALSE, 'is_direct_supervisor_approve' => TRUE, 'is_official_approve' => FALSE])->get();
      return view('head_division/performance/new/index', compact('datas'));
  }

  public function show($id)
  {
      $data=NewPerformanceTarget::where('id', $id)->first();
      $count=NewPerformanceTargetScore::where('new_performance_target_id', $id)->count();
      $activities=NewPerformanceTargetScore::where(['new_performance_target_id' => $id, 'is_deleted' => FALSE])->orderBy('created_at', 'ASC')->get();
      $check=NewPerformanceTargetWorkBehaviour::where(['new_performance_target_id' => $id, 'is_deleted' => FALSE])->count();
      $workbehaviours=NewPerformanceTargetWorkBehaviour::where(['new_performance_target_id' => $id, 'is_deleted' => FALSE])->orderBy('updated_at', 'DESC')->get();
      return view('head_division/performance/new/show', compact('data', 'count', 'activities', 'check', 'workbehaviours'));
  }

  public function done(Request $request, $id){
      date_default_timezone_set('Asia/Jakarta');
      $date=date('Y-m-d');

      DB::table('new_performance_target')->whereId($id)->update([
        'is_official_approve' => TRUE,
        'official_asseseed_time' => $date
      ]);

      Alert::success('Berhasil', 'SKP Telah Diterbitkan');
      return redirect()->route('divheadnpt');
    }
}
