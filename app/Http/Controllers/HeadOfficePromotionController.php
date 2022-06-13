<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\NewPromotion;
use App\Models\NewPromotionScore;
use App\Models\NewPromotionFile;
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
      $datas=NewPromotion::where(['is_locked' => TRUE, 'is_assesed' => TRUE, 'is_finish' => FALSE, 'is_rejected' => FALSE, 'is_deleted' => FALSE])->get();
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
      $data=NewPromotion::where('id', $id)->first();
      $scores=NewPromotionScore::where('new_promotion_id', $id)->get();
      $files=NewPromotionFile::where('new_promotion_id', $id)->get();

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
      DB::table('new_promotion')->whereId($id)->update([
        'is_finish'        => TRUE
      ]);

      Alert::success('Berhasil', 'Pengajuan Kenaikan Pangkat Diterima');
      return redirect()->route('officeheadpr');
    }

}
