<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewAssesmentCredit;
use App\Models\NewAssesmentCreditScore;
use App\Models\NewAssesmentCreditScoreRejected;
use App\Models\ReferenceAssesmentCreditScoreActivity;
use App\Models\ReferenceEducationCreditScore;
use App\Models\NewPerformanceTarget;
use App\Models\NewPerformanceTargetScore;
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
        $datas=NewAssesmentCredit::where(['is_ready' => TRUE, 'is_finished' => FALSE])->get();
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
      $assesment=NewAssesmentCredit::where('id', $id)->first();
      $datas=NewAssesmentCreditScore::where('new_assesment_credit_id' , $id)->orderBy('reference_assesment_credit_score_activity_id', 'asc')->get();
      return view('assesor/creditscore/show', compact('assesment', 'datas'));
    }

    public function score($id, $idc)
    {
      $data=NewAssesmentCreditScore::where('id', $id)->first();
      if($data->total_evaluator_credit_score != null){
        Alert::error('Gagal', 'Penilaian Sudah Dikunci');
        return redirect()->back();
      }else{
        $reject=0;
        $code_low=0;
        $code_up=0;
        $getforif=ReferenceAssesmentCreditScoreActivity::where('id', $data->reference_assesment_credit_score_activity_id)->first();

        if($getforif->activity_item == "Melaksanakan proses pembelajaran"){
          $code_low=1;
          $code_up=16;
        }elseif($getforif->activity_item == "Melaksanakan tugas lain yang relevan dengan fungsi sekolah"){
          $code_low=16;
          $code_up=28;
        }elseif($getforif->activity_item == "Melaksanakan pengembangan diri"){
          $code_low=28;
          $code_up=38;
        }elseif($getforif->activity_item == "Melaksanakan publikasi ilmiah"){
          $code_low=38;
          $code_up=59;
        }elseif($getforif->activity_item == "Melaksanakan karya inovatif"){
          $code_low=59;
          $code_up=71;
        }elseif($getforif->activity_item == "Memperoleh gelar/ijazah yang tidak sesuai dengan bidang yang diampuhnya"){
          $code_low=71;
          $code_up=74;
        }elseif($getforif->activity_item == "Melaksanakan kegiatan yang mendukung tugas guru"){
          $code_low=74;
          $code_up=85;
        }elseif($getforif->activity_item == "Perolehan penghargaan/tanda jasa Satya Lancana Karya Satya"){
          $code_low=75;
          $code_up=89;
        }

        $data2=NewAssesmentCredit::where('id', $idc)->first();
        $filedatas=NewPerformanceTargetScore::where(['new_performance_target_id' => $data2->new_performance_target_id, 'is_deleted' => FALSE])->get();
        foreach($filedatas as $filedata) {
          $rejected=NewAssesmentCreditScoreRejected::where([
            'new_assesment_credit_id' => $idc,
            'new_assesment_credit_score_id' => $id,
            'new_performance_target_score_id' => $filedata->id
            ])->first();
          if($rejected != null){
            $point=$filedata->refActivityCreditScore->credit_score*$rejected->qty;
            $reject=$reject+$point;
          }
        }

        $total_evaluator_credit_score=$data->new_user_credit_score-$reject;

        return view('assesor/creditscore/score', compact('id', 'idc', 'data', 'code_up', 'code_low', 'data2', 'filedatas', 'reject', 'total_evaluator_credit_score'));
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
        $performancetargetscore=NewPerformanceTargetScore::where('id', $idperformancescore)->first();
        $assesmentscore=NewAssesmentCreditScore::where('id', $idassesmentscore)->first();
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

        $check=NewPerformanceTargetScore::where('id', $idperformancescore)->first();
        if($check->realization_qty < $request->qty){
          Alert::error('Gagal', 'Jumlah Kegiatan Yang Ditolak Lebih Banyak Daripada Kegiatan Yang Ada!');
          return redirect()->back();
        }else{
          $data = new NewAssesmentCreditScoreRejected;
          $data->new_assesment_credit_id = $idassesment;
          $data->new_assesment_credit_score_id = $idassesmentscore;
          $data->new_performance_target_score_id = $idperformancescore;
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
        $check=NewAssesmentCreditScore::where('id' , $id)->first();
        $total=$check->old_credit_score+$request->new_evaluator_credit_score;

        $data = NewAssesmentCreditScore::findOrFail($id);
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
      $gets = NewAssesmentCreditScore::where('new_assesment_credit_id', $id)->get();
      $total_assessment_credit_score=0;
      foreach($gets as $get){
        $total_assessment_credit_score=$total_assessment_credit_score+$get->total_evaluator_credit_score;
      }
      $date = Carbon::now();
      $user = auth()->user()->personalData->name;
      $data = NewAssesmentCredit::findOrFail($id);
      $data->update([
          'is_finished'    => TRUE,
          'assessment_date'  => $date,
          'assessed_by' => $user,
          'total_assessment_credit_score' => $total_assessment_credit_score
      ]);

      if($data){
            Alert::success('Berhasil', 'PAK Sudah Dinilai');
            return redirect()->route('assesorcr');
      } else {
            Alert::error('Gagal', 'Gagal Menilai PAK! Silahkan ulangi beberapa saat lagi');
            return redirect()->back();
      }
    }
}
