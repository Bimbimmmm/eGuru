<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\NewPromotion;
use App\Models\NewPromotionScore;
use App\Models\NewPromotionFile;
use App\Models\ReferencePromotionCreditScore;
use App\Models\ReferencePromotionFile;
use App\Models\ReferenceAssesmentCreditScoreActivity;
use App\Models\AssesmentCredit;
use App\Models\AssesmentCreditScore;
use Validator;
use Alert;

class AssesorPromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $datas=NewPromotion::where(['is_locked' => TRUE, 'is_assesed' => FALSE, 'is_finish' => FALSE, 'is_rejected' => FALSE, 'is_deleted' => FALSE])->get();
      return view('assesor/promotion/index', compact('datas'));
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
        $data=NewPromotion::where('id', $id)->first();
        $scores=NewPromotionScore::where('new_promotion_id', $id)->get();
        $files=NewPromotionFile::where('new_promotion_id', $id)->get();
        $count_credit_score=ReferencePromotionCreditScore::where('id', $data->reference_promotion_credit_score_id)->first();

        //Count Unsur Utama
        $major_credit_score=0;
        foreach ($scores as $score) {
          if($score->reference_assesment_credit_score_activity_id == 1){
            $major_credit_score=$major_credit_score+$score->get_credit_score;
          }else if($score->reference_assesment_credit_score_activity_id == 2){
            $major_credit_score=$major_credit_score+$score->get_credit_score;
          }else if($score->reference_assesment_credit_score_activity_id == 3){
            $major_credit_score=$major_credit_score+$score->get_credit_score;
          }else if($score->reference_assesment_credit_score_activity_id == 4){
            $major_credit_score=$major_credit_score+$score->get_credit_score;
          }else if($score->reference_assesment_credit_score_activity_id == 5){
            $major_credit_score=$major_credit_score+$score->get_credit_score;
          }
        }
        //Count Unsur PKB
        $self_development_credit_score=0;
        foreach ($scores as $score) {
          if($score->reference_assesment_credit_score_activity_id == 6){
            $self_development_credit_score=$self_development_credit_score+$score->get_credit_score;
          }
        }
        //Count Unsur Karya Ilmiah
        $scientific_credit_score=0;
        foreach ($scores as $score) {
          if($score->reference_assesment_credit_score_activity_id == 7){
            $scientific_credit_score=$scientific_credit_score+$score->get_credit_score;
          }else if($score->reference_assesment_credit_score_activity_id == 8){
            $scientific_credit_score=$scientific_credit_score+$score->get_credit_score;
          }
        }
        //Count Unsur Penunjang
        $support_credit_score=0;
        foreach ($scores as $score) {
          if($score->reference_assesment_credit_score_activity_id == 9){
            $support_credit_score=$support_credit_score+$score->get_credit_score;
          }else if($score->reference_assesment_credit_score_activity_id == 10){
            $support_credit_score=$support_credit_score+$score->get_credit_score;
          }else if($score->reference_assesment_credit_score_activity_id == 11){
            $support_credit_score=$support_credit_score+$score->get_credit_score;
          }
        }

        //is promote
        $is_promote=0;
        $reason="Masih Membutuhkan";

        if($count_credit_score->major_credit_score < $major_credit_score || $count_credit_score->major_credit_score == $major_credit_score){
          $is_promote=$is_promote+1;
        }else{
          $minus=$count_credit_score->major_credit_score - $major_credit_score;
          $reason=$reason . ' ' . $minus . ' ' . "Unsur Utama";
        }


        if($count_credit_score->self_development_credit_score < $self_development_credit_score || $count_credit_score->self_development_credit_score == $self_development_credit_score){
          $is_promote=$is_promote+1;
        }else{
          $minus=$count_credit_score->self_development_credit_score - $self_development_credit_score;
          $reason=$reason . ' ' . $minus . ' ' . "Unsur Pengembangan Diri";
        }



        if($count_credit_score->scientific_credit_score < $scientific_credit_score || $count_credit_score->scientific_credit_score == $scientific_credit_score){
          $is_promote=$is_promote+1;
        }else{
          $minus=$count_credit_score->scientific_credit_score - $scientific_credit_score;
          $reason=$reason . ' ' . $minus . ' ' . "Unsur Karya Ilmiah";
        }


        if($count_credit_score->support_credit_score > $support_credit_score || $count_credit_score->support_credit_score == $support_credit_score){
          $is_promote=$is_promote+1;
        }else{
          $plus=$support_credit_score - $count_credit_score->support_credit_score;
          $reason=$reason . "Berlebih" . ' ' . $plus . ' ' . "Unsur Penunjang";
        }

        return view('assesor/promotion/show', compact('data', 'scores', 'files', 'reason', 'is_promote'));
    }

    public function accepted(Request $request, $id)
    {
      $rules = [
          'new_work_year' => 'required'
      ];

      $messages = [
          'new_work_year.required' => 'Masa Kerja Baru Wajib Diisi'
      ];

      $validator = Validator::make($request->all(), $rules, $messages);

      if($validator->fails()){
          return redirect()->back()->withErrors($validator)->withInput($request->all);
      }

        $name=auth()->user()->personalData->name;

        DB::table('new_promotion')->whereId($id)->update([
          'new_work_year'    => $request->new_work_year,
          'is_assesed'       => TRUE,
          'asseseed_by'      => $name
        ]);

        Alert::success('Berhasil', 'Pengajuan Kenaikan Pangkat Diterima');
        return redirect()->route('assesorpr');
    }

    public function rejected($id, $reason)
    {
        $name=auth()->user()->personalData->name;

        DB::table('new_promotion')->whereId($id)->update([
          'is_assesed'       => TRUE,
          'is_rejected'      => TRUE,
          'asseseed_by'      => $name,
          'rejected_reason'  => $reason
        ]);

        Alert::success('Berhasil', 'Pengajuan Kenaikan Pangkat Ditolak');
        return redirect()->route('assesorpr');
    }

}
