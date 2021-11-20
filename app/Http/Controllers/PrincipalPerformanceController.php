<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PerformanceTarget;
use App\Models\PerformanceTargetScore;
use App\Models\PerformanceTargetWorkBehavior;
use App\Models\ReferenceWorkBehavior;
use App\Models\ReferenceActivityCreditScore;
use App\Models\PositionMapping;
use Validator;
use Alert;

class PrincipalPerformanceController extends Controller
{
  public function index()
  {
      $user_id = auth()->user()->id;
      $position_mapping=PositionMapping::where(['principal_id' => $user_id, 'is_active' => TRUE])->first();
      $datas=PerformanceTarget::where(['position_mapping_id' => $position_mapping->id, 'is_deleted' => FALSE, 'is_direct_supervisor_approve' => FALSE])->get();
      return view('principal/performance/index', compact('datas'));
  }

  public function show($id)
  {
      $data=PerformanceTarget::where('id', $id)->first();
      $count=PerformanceTargetScore::where('performance_target_id', $id)->count();
      $activities=PerformanceTargetScore::where(['performance_target_id' => $id, 'is_deleted' => FALSE])->orderBy('created_at', 'ASC')->get();
      $check=PerformanceTargetWorkBehavior::where(['performance_target_id' => $id, 'is_deleted' => FALSE])->count();
      $workbehaviours=PerformanceTargetWorkBehavior::where(['performance_target_id' => $id, 'is_deleted' => FALSE])->orderBy('updated_at', 'DESC')->get();
      return view('principal/performance/show', compact('data', 'count', 'activities', 'check', 'workbehaviours'));
  }

  public function score($id, $idpt){
    $data=PerformanceTargetScore::where(['id' => $id, 'is_deleted' => FALSE])->first();
    return view('principal/performance/score', compact('id', 'idpt', 'data'));
  }

  public function scoreact(Request $request, $id, $idpt){
    $rules = [
        'realization_qty'        => 'required',
        'realization_quality'    => 'required',
        'realization_time'       => 'required',
        'realization_time_unit'  => 'required',
        'realization_cost'       => 'required'
    ];

    $messages = [
        'realization_qty.required'         => 'Realisasi Banyaknya Kegiatan Wajib Diisi',
        'realization_quality.required'     => 'Realisasi Kualitas Kegiatan Wajib Diisi',
        'realization_time.required'        => 'Realisasi Waktu Kegiatan Wajib Diisi',
        'realization_time_unit.required'   => 'Realisasi Unit Waktu Kegiatan Wajib Diisi',
        'realization_cost.required'        => 'Realisasi Biaya Kegiatan Wajib Diisi'
    ];

    $validator = Validator::make($request->all(), $rules, $messages);

    if($validator->fails()){
        return redirect()->back()->withErrors($validator)->withInput($request->all);
    }

    $count=(float)276.00;
    $countt=(float)100-(float)$request->realization_quality;
    (float)$calculation=$count-$countt;
    (float)$performance_value=$calculation/3;
    $gettargetscore=PerformanceTargetScore::where('id', $id)->first();
    $getcs=ReferenceActivityCreditScore::where('id', $gettargetscore->reference_activity_credit_score_id)->first();
    if($getcs->credit_score == null){
        (float)$realization_credit_score=$gettargetscore->target_credit_score*$request->realization_qty;
    }else{
        (float)$realization_credit_score=$getcs->credit_score*$request->realization_qty;
    }

    $data = PerformanceTargetScore::findOrFail($id);
    $data->update([
      'realization_credit_score' => $realization_credit_score,
      'realization_qty' => $request->realization_qty,
      'realization_output' => $gettargetscore->target_output,
      'realization_quality' => $request->realization_quality,
      'realization_time' => $request->realization_time,
      'realization_cost' => $request->realization_cost,
      'calculation' => $calculation,
      'performance_value' => $performance_value
    ]);

    if($data){
        Alert::success('Berhasil', 'Kegiatan Berhasil Dinilai');
        return redirect()->route('principalptshow', $idpt);
    } else {
        Alert::error('Gagal', 'Gagal Menilai Kegiatan! Silahkan ulangi beberapa saat lagi');
        return redirect()->back();
    }
  }

  public function done(Request $request, $idpt){
      $count=PerformanceTargetScore::where(['performance_target_id' => $idpt, 'is_deleted' => FALSE])->count();
      $getperformancetargetscores=PerformanceTargetScore::where(['performance_target_id' => $idpt, 'is_deleted' => FALSE])->get();
      $getwbscores=PerformanceTargetWorkBehavior::where(['performance_target_id' => $idpt, 'is_deleted' => FALSE])->get();
      $countwb=PerformanceTargetWorkBehavior::where(['performance_target_id' => $idpt, 'is_deleted' => FALSE])->count();
      (float)$score=0;
      foreach ($getperformancetargetscores as $getperformancetargetscore) {
          $score=$score+$getperformancetargetscore->performance_value;
      }
      (float)$scorewb=0;
      foreach ($getwbscores as $getwbscore) {
          $scorewb=$scorewb+$getwbscore->score;
      }
      (float)$finalscore=($score/$count)*60/100;
      (float)$secondscore=($scorewb/$countwb)*40/100;
      (float)$performance_score=$finalscore+$secondscore;

      date_default_timezone_set('Asia/Makassar');
      $date=date('Y-m-d');

      $data = PerformanceTarget::findOrFail($idpt);
      $data->update([
        'performance_score' => $performance_score,
        'is_direct_supervisor_approve' => TRUE,
        'direct_supervisor_asseseed_time' => $date
      ]);

      if($data){
          Alert::success('Berhasil', 'SKP Telah Selesai Dinilai');
          return redirect()->route('principalpt');
      } else {
          Alert::error('Gagal', 'Gagal Menilai SKP! Silahkan ulangi beberapa saat lagi');
          return redirect()->back();
      }
  }
}
