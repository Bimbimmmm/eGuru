<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewPerformanceTarget;
use App\Models\NewPerformanceTargetScore;
use App\Models\NewPerformanceTargetWorkBehaviour;
use App\Models\ReferenceNewWorkBehaviour;
use Validator;
use Alert;

class PrincipalNewPerformanceWorkBehaviorController extends Controller
{
  public function create($id)
  {
    $gets=ReferenceNewWorkBehaviour::where('is_deleted', FALSE)->get();

    foreach($gets as $get) {
      if($get->name != "Kepemimpinan"){
        $data = new NewPerformanceTargetWorkBehaviour;
        $data->new_performance_target_id = $id;
        $data->reference_new_work_behaviour_id = $get->id;
        $data->score = NULL;
        $data->is_deleted = FALSE;
        $save = $data->save();
      }
    }
    Alert::success('Berhasil', 'Tabel Perilaku Kerja Berhasil Digenerate');
    return redirect()->back();
  }

  public function show($id, $idpt){
    $data=NewPerformanceTargetWorkBehaviour::where(['id' => $id, 'is_deleted' => FALSE])->first();
    return view('principal/performance/new/wbscore', compact('data', 'id', 'idpt'));
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
    $data = NewPerformanceTargetWorkBehaviour::findOrFail($id);
    $data->update([
      'score' => $request->score
    ]);

    if($data){
        Alert::success('Berhasil', 'Indikator Kinerja Berhasil Dinilai');
        return redirect()->route('principalnptshow', $idpt);
    } else {
        Alert::error('Gagal', 'Gagal Menilai Indikator Kinerja! Silahkan ulangi beberapa saat lagi');
        return redirect()->back();
    }
  }
}
