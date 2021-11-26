<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AssesmentCredit;
use App\Models\AssesmentCreditScore;
use App\Models\AssesmentCreditScoreRejected;
use App\Models\ReferenceAssesmentCreditScoreActivity;
use App\Models\ReferenceEducationCreditScore;
use App\Models\PerformanceTarget;
use App\Models\PerformanceTargetScore;
use App\Models\ReferenceActivityCreditScore;
use Validator;
use Alert;
use Carbon\Carbon;

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
      $data=AssesmentCreditScore::where('id', $id)->first();
      if($data->total_evaluator_credit_score != null){
        Alert::error('Gagal', 'Penilaian Sudah Dikunci');
        return redirect()->back();
      }else{
        $reject=0;
        $getforif=ReferenceAssesmentCreditScoreActivity::where('id', $data->reference_assesment_credit_score_activity_id)->first();
        $data2=AssesmentCredit::where('id', $idc)->first();
        $filedatas=PerformanceTargetScore::where(['performance_target_id' => $data2->performance_target_id, 'is_deleted' => FALSE])->get();
        foreach($filedatas as $filedata) {
          $rejected=AssesmentCreditScoreRejected::where([
            'assesment_credit_id' => $idc,
            'assesment_credit_score_id' => $id,
            'performance_target_score_id' => $filedata->id
            ])->first();
          if($rejected != null){
            $point=$filedata->refActivityCreditScore->credit_score*$rejected->qty;
            $reject=$reject+$point;
          }
        }

        $total_evaluator_credit_score=$data->new_user_credit_score-$reject;

        return view('assesor/creditscore/score', compact('id', 'idc', 'data', 'getforif', 'data2', 'filedatas', 'reject', 'total_evaluator_credit_score'));
      }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function reject($idperformancescore, $idassesmentscore, $idassesment)
    {
        $performancetargetscore=PerformanceTargetScore::where('id', $idperformancescore)->first();
        $assesmentscore=AssesmentCreditScore::where('id', $idassesmentscore)->first();
        return view('assesor/creditscore/reject', compact('performancetargetscore', 'assesmentscore', 'idassesment' ,'idassesmentscore'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function rejectstore(Request $request, $idperformancescore, $idassesmentscore, $idassesment)
    {
        $rules = [
            'qty'             => 'required',
            'reason'          => 'required',
            'suggestion'      => 'required'
        ];

        $messages = [
            'qty.required'            => 'Jumlah Kegiatan Yang Ditolak Wajib Diisi',
            'reason.required'         => 'Alasan Penolakan Wajib Diisi',
            'suggestion.required'     => 'Saran Perbaikan Wajib Diisi'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $check=PerformanceTargetScore::where('id', $idperformancescore)->first();
        if($check->realization_qty < $request->qty){
          Alert::error('Gagal', 'Jumlah Kegiatan Yang Ditolak Lebih Banyak Daripada Kegiatan Yang Ada!');
          return redirect()->back();
        }else{
          $data = new AssesmentCreditScoreRejected;
          $data->assesment_credit_id = $idassesment;
          $data->assesment_credit_score_id = $idassesmentscore;
          $data->performance_target_score_id = $idperformancescore;
          $data->qty = $request->qty;
          $data->reason = $request->reason;
          $data->suggestion = $request->suggestion;
          $save = $data->save();

          if($save){
              Alert::success('Berhasil', 'Kegiatan Berhasil Ditolak');
              return redirect()->route('assesorcrscore', array($idassesmentscore, $idassesment));
          } else {
              Alert::error('Gagal', 'Gagal Menolak Kegiatan! Silahkan ulangi beberapa saat lagi');
              return redirect()->back();
          }
        }
      }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function scoring(Request $request, $id, $idc)
    {

        $rules = [
            'new_evaluator_credit_score'  => 'required'
        ];

        $messages = [
            'new_evaluator_credit_score.required'  => 'Nilai Dari Penilai Wajib Diisi'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }
        $check=AssesmentCreditScore::where('id' , $id)->first();
        $total=$check->old_credit_score+$request->new_evaluator_credit_score;

        $data = AssesmentCreditScore::findOrFail($id);
        $data->update([
            'new_evaluator_credit_score'    => $request->new_evaluator_credit_score,
            'total_evaluator_credit_score'  => $total
        ]);

        if($data){
              Alert::success('Berhasil', 'Kegiatan Sudah Dinilai');
              return redirect()->route('assesorcrshow', $idc);
        } else {
              Alert::error('Gagal', 'Gagal Menilai Kegiatan! Silahkan ulangi beberapa saat lagi');
              return redirect()->back();
        }
    }

    public function lock(Request $request, $id)
    {
      $gets = AssesmentCreditScore::where('assesment_credit_id', $id)->get();
      $total_assessment_credit_score=0;
      foreach($gets as $get){
        $total_assessment_credit_score=$total_assessment_credit_score+$get->total_evaluator_credit_score;
      }
      $date = Carbon::now();
      $user = auth()->user()->personalData->name;
      $data = AssesmentCredit::findOrFail($id);
      $data->update([
          'is_finished'    => TRUE,
          'assessment_date'  => $date,
          'assessed_by' => $user,
          'total_assessment_credit_score' => $total_assessment_credit_score
      ]);

      if($data){
            Alert::success('Berhasil', 'Kegiatan Sudah Dinilai');
            return redirect()->route('assesorcr');
      } else {
            Alert::error('Gagal', 'Gagal Menilai Kegiatan! Silahkan ulangi beberapa saat lagi');
            return redirect()->back();
      }
    }
}
