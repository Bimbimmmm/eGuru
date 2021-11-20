<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PerformanceTarget;
use App\Models\PerformanceTargetScore;
use App\Models\PerformanceTargetWorkBehavior;
use App\Models\ReferenceWorkBehavior;
use App\Models\ReferenceActivityCreditScore;
use App\Models\PositionMapping;
use Validator;
use Alert;

class DivisionHeadPerformanceController extends Controller
{
  public function index()
  {
      $user_id = auth()->user()->id;
      $position_mapping=PositionMapping::where(['supervisor_id' => $user_id, 'is_active' => TRUE])->first();
      $datas=PerformanceTarget::where(['position_mapping_id' => $position_mapping->id, 'is_deleted' => FALSE, 'is_direct_supervisor_approve' => TRUE, 'is_official_approve' => FALSE])->get();
      return view('head_division/performance/index', compact('datas'));
  }

  public function show($id)
  {
      $data=PerformanceTarget::where('id', $id)->first();
      $count=PerformanceTargetScore::where('performance_target_id', $id)->count();
      $activities=PerformanceTargetScore::where(['performance_target_id' => $id, 'is_deleted' => FALSE])->orderBy('created_at', 'ASC')->get();
      $check=PerformanceTargetWorkBehavior::where(['performance_target_id' => $id, 'is_deleted' => FALSE])->count();
      $workbehaviours=PerformanceTargetWorkBehavior::where(['performance_target_id' => $id, 'is_deleted' => FALSE])->orderBy('updated_at', 'DESC')->get();
      return view('head_division/performance/show', compact('data', 'count', 'activities', 'check', 'workbehaviours'));
  }

  public function done(Request $request, $id){
      date_default_timezone_set('Asia/Jakarta');
      $date=date('Y-m-d');

      DB::table('performance_target')->whereId($id)->update([
        'is_official_approve' => TRUE,
        'official_asseseed_time' => $date
      ]);

      Alert::success('Berhasil', 'SKP Telah Diterbitkan');
      return redirect()->route('divheadpt');
    }
}
