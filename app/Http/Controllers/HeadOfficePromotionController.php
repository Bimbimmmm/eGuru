<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Promotion;
use App\Models\PromotionScore;
use App\Models\PromotionFile;
use App\Models\ReferencePromotionCreditScore;
use App\Models\ReferencePromotionFile;
use App\Models\ReferenceAssesmentCreditScoreActivity;
use App\Models\AssesmentCredit;
use App\Models\AssesmentCreditScore;
use Validator;
use Alert;

class HeadOfficePromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $datas=Promotion::where(['is_locked' => TRUE, 'is_assesed' => TRUE, 'is_finish' => FALSE, 'is_rejected' => FALSE, 'is_deleted' => FALSE])->get();
      return view('head_office/promotion/index', compact('datas'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $data=Promotion::where('id', $id)->first();
      $scores=PromotionScore::where('promotion_id', $id)->get();
      $files=PromotionFile::where('promotion_id', $id)->get();

      return view('head_office/promotion/show', compact('data', 'scores', 'files'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function approve($id)
    {
      DB::table('promotion')->whereId($id)->update([
        'is_finish'        => TRUE
      ]);

      Alert::success('Berhasil', 'Pengajuan Kenaikan Pangkat Diterima');
      return redirect()->route('officeheadpr');
    }

}
