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

class PrincipalPerformanceWorkBehaviorController extends Controller
{
  public function create($id)
  {
    $gets=ReferenceWorkBehavior::where('is_deleted', FALSE)->get();

    foreach($gets as $get) {
      $data = new PerformanceTargetWorkBehavior;
      $data->performance_target_id = $id;
      $data->reference_work_behavior_id = $get->id;
      $data->score = NULL;
      $data->is_deleted = FALSE;
      $save = $data->save();
    }
    Alert::success('Berhasil', 'Tabel Perilaku Kerja Berhasil Digenerate');
    return redirect()->back();
  }

  public function show($id, $idpt){
    $data=PerformanceTargetWorkBehavior::where(['id' => $id, 'is_deleted' => FALSE])->first();
    return view('principal/performance/wbscore', compact('data', 'id', 'idpt'));
  }

  public function score(Request $request, $id, $idpt){
    $rules = [
        'score'   => 'required'
    ];

    $messages = [
        'score.required'   => 'Skor Indikator Wajib Diisi'
    ];

    $validator = Validator::make($request->all(), $rules, $messages);

    if($validator->fails()){
        return redirect()->back()->withErrors($validator)->withInput($request->all);
    }
    $data = PerformanceTargetWorkBehavior::findOrFail($id);
    $data->update([
      'score' => $request->score
    ]);

    if($data){
        Alert::success('Berhasil', 'Indikator Kinerja Berhasil Dinilai');
        return redirect()->route('principalptshow', $idpt);
    } else {
        Alert::error('Gagal', 'Gagal Menilai Indikator Kinerja! Silahkan ulangi beberapa saat lagi');
        return redirect()->back();
    }
  }

}
