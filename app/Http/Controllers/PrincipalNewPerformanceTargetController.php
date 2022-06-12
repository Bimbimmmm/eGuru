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

class PrincipalNewPerformanceTargetController extends Controller
{
  public function index()
  {
      $user_id = auth()->user()->id;
      $position_mapping=PositionMapping::where(['principal_id' => $user_id, 'is_active' => TRUE])->first();
      $datas=NewPerformanceTarget::where(['position_mapping_id' => $position_mapping->id, 'is_ready' => TRUE, 'is_direct_supervisor_approve' => FALSE, 'is_deleted' => FALSE])->get();
      return view('principal/performance/new/index', compact('datas'));
  }

  public function show($id)
  {
      $data=NewPerformanceTarget::where('id', $id)->first();
      $count=NewPerformanceTargetScore::where('new_performance_target_id', $id)->count();
      $activities=NewPerformanceTargetScore::where(['new_performance_target_id' => $id, 'is_deleted' => FALSE])->orderBy('created_at', 'ASC')->get();
      $check=NewPerformanceTargetWorkBehaviour::where(['new_performance_target_id' => $id, 'is_deleted' => FALSE])->count();
      $workbehaviours=NewPerformanceTargetWorkBehaviour::where(['new_performance_target_id' => $id, 'is_deleted' => FALSE])->orderBy('updated_at', 'DESC')->get();
      return view('principal/performance/new/show', compact('data', 'count', 'activities', 'check', 'workbehaviours'));
  }

  public function score($id, $idpt){
    $data=NewPerformanceTargetScore::where(['id' => $id, 'is_deleted' => FALSE])->first();
    return view('principal/performance/new/score', compact('id', 'idpt', 'data'));
  }

  public function scoreact(Request $request, $id, $idpt){
    $rules = [
        'realization_qty'        => 'required',
        'realization_quality'    => 'required',
        'realization_time'       => 'required'
    ];

    $messages = [
        'realization_qty.required'         => 'Realisasi Banyaknya Kegiatan Wajib Diisi',
        'realization_quality.required'     => 'Realisasi Kualitas Kegiatan Wajib Diisi',
        'realization_time.required'        => 'Realisasi Waktu Kegiatan Wajib Diisi'
    ];

    $validator = Validator::make($request->all(), $rules, $messages);

    if($validator->fails()){
        return redirect()->back()->withErrors($validator)->withInput($request->all);
    }

    //Start Declare Variable
    $cat_qty;
    $cat_quality;
    $cat_time;
    $qtyct;
    $qualityct;
    $timect;
    $isqty;
    $isquality;
    $istime;
    $category;
    $score;
    $weighted_value;
    $divider;
    $dividerr;
    $realization_credit_score;
    //End Declare Variable

    $gettargetscore=NewPerformanceTargetScore::where('id', $id)->first();
    if($gettargetscore->refPerformanceElement->credit_score == NULL){
      $realization_credit_score=$gettargetscore->target_credit_score*$request->realization_qty;
    }else{
      $realization_credit_score=$gettargetscore->refPerformanceElement->credit_score*$request->realization_qty;
    }
    //Start QTY
    $ach_qty=round($request->realization_qty/$gettargetscore->target_qty*100);
    if($ach_qty > 100){
      $cat_qty="Sangat Baik";
      $qtyct=5;
    }elseif ($ach_qty == 100) {
      $cat_qty="Baik";
      $qtyct=4;
    }elseif ($ach_qty > 79) {
      $cat_qty="Cukup";
      $qtyct=3;
    }elseif ($ach_qty > 59) {
      $cat_qty="Kurang";
      $qtyct=2;
    }elseif ($ach_qty < 60) {
      $cat_qty="Sangat Kurang";
      $qtyct=1;
    }

    if($request->realization_qty > 0){
      $isqty=1;
    }else{
      $isqty=0;
    }
    //End QTY

    //Start Quality
    $ach_quality=$request->realization_quality/$gettargetscore->target_quality*100;
    if($ach_quality > 100){
      $cat_quality="Sangat Baik";
      $qualityct=5;
    }elseif ($ach_quality == 100) {
      $cat_quality="Baik";
      $qualityct=4;
    }elseif ($ach_quality > 79) {
      $cat_quality="Cukup";
      $qualityct=3;
    }elseif ($ach_quality > 59) {
      $cat_quality="Kurang";
      $qualityct=2;
    }elseif ($ach_quality < 60) {
      $cat_quality="Sangat Kurang";
      $qualityct=1;
    }

    if($request->realization_quality > 0){
      $isquality=1;
    }else{
      $isquality=0;
    }
    //End Quality

    //Start Time
    $ach_time=(1+(1-($request->realization_time/$gettargetscore->target_time)))*100;
    if($ach_time > 100){
      $cat_time="Sangat Baik";
      $timect=5;
    }elseif ($ach_time == 100) {
      $cat_time="Baik";
      $timect=4;
    }elseif ($ach_time > 79) {
      $cat_time="Cukup";
      $timect=3;
    }elseif ($ach_time > 59) {
      $cat_time="Kurang";
      $timect=2;
    }elseif ($ach_time < 60) {
      $cat_time="Sangat Kurang";
      $timect=1;
    }

    if($request->realization_time > 0){
      $istime=1;
    }else{
      $istime=0;
    }
    //End Time

    //Start Category
    $catct=($qtyct+$qualityct+$timect)/($isqty+$isquality+$istime);
    if($catct > 4.49){
      $category="Sangat Baik";
      $score=120;
      $dividerr=1*1/100*$score;
    }elseif ($catct > 3.66) {
      $category="Baik";
      $score=100;
      $dividerr=0.8*1/100*$score;
    }elseif ($catct > 2.66) {
      $category="Cukup";
      $score=80;
      $dividerr=0.6*1/100*$score;
    }elseif ($catct > 1.66) {
      $category="Kurang";
      $score=60;
      $dividerr=0.4*1/100*$score;
    }else{
      $category="Sangat Kurang";
      $score=25;
      $dividerr=0.2*1/100*$score;
    }
    //End Category

    //Start Weighted Value
    if($catct > 0){
      $divider=1;
    }else{
      $divider=0;
    }

    if($gettargetscore->refPerformanceElement->code < 71 ){
      $weighted_value=$score/$divider;
    }else{
      $weighted_value=$dividerr;
    }
    //End Weighted Value

    $data = NewPerformanceTargetScore::findOrFail($id);
    $data->update([
      'realization_credit_score' => $realization_credit_score,
      'realization_qty' => $request->realization_qty,
      'ach_qty' => $ach_qty,
      'cat_qty' => $cat_qty,
      'realization_quality' => $request->realization_quality,
      'ach_quality' => $ach_quality,
      'cat_quality' => $cat_quality,
      'realization_time' => $request->realization_time,
      'ach_time' => $ach_time,
      'cat_time' => $cat_time,
      'category' => $category,
      'score' => $score,
      'weighted_value' => $weighted_value
    ]);

    if($data){
        Alert::success('Berhasil', 'Kegiatan Berhasil Dinilai');
        return redirect()->route('principalnptshow', $idpt);
    } else {
        Alert::error('Gagal', 'Gagal Menilai Kegiatan! Silahkan ulangi beberapa saat lagi');
        return redirect()->back();
    }
  }

  public function done(Request $request, $idpt){
      $count=NewPerformanceTargetScore::where(['new_performance_target_id' => $idpt, 'is_deleted' => FALSE])->count();
      $getperformancetargetscores=NewPerformanceTargetScore::where(['new_performance_target_id' => $idpt, 'is_deleted' => FALSE])->get();
      $getwbscores=NewPerformanceTargetWorkBehaviour::where(['new_performance_target_id' => $idpt, 'is_deleted' => FALSE])->get();
      $countwb=NewPerformanceTargetWorkBehaviour::where(['new_performance_target_id' => $idpt, 'is_deleted' => FALSE])->count();
      (float)$score=0;
      (float)$adt_score=0;
      foreach ($getperformancetargetscores as $getperformancetargetscore) {
        if($getperformancetargetscore->refPerformanceElement->code < 71){
          $score=$score+$getperformancetargetscore->weighted_value;
        }else{
          $adt_score=$adt_score+$getperformancetargetscore->weighted_value;
        }
      }

      (float)$scorewb=0;
      foreach ($getwbscores as $getwbscore) {
          $scorewb=$scorewb+$getwbscore->score;
      }
      (float)$finalscore=(($score/$count)+$adt_score)*60/100;
      (float)$secondscore=($scorewb/$countwb)*40/100;
      (float)$new_performance_score=$finalscore+$secondscore;

      if($new_performance_score > 120){
        $new_performance_score=120;
      }else{
        $new_performance_score=$new_performance_score;
      }

      date_default_timezone_set('Asia/Makassar');
      $date=date('Y-m-d');

      $data = NewPerformanceTarget::findOrFail($idpt);
      $data->update([
        'performance_score' => $new_performance_score,
        'is_direct_supervisor_approve' => TRUE,
        'direct_supervisor_asseseed_time' => $date
      ]);

      if($data){
          Alert::success('Berhasil', 'SKP Telah Selesai Dinilai');
          return redirect()->route('principalnpt');
      } else {
          Alert::error('Gagal', 'Gagal Menilai SKP! Silahkan ulangi beberapa saat lagi');
          return redirect()->back();
      }
  }
}
