<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewPromotion;
use App\Models\NewPromotionScore;
use App\Models\NewPromotionFile;

class DivisionHeadPromotionController extends Controller
{
    public function index()
    {
      $datas=NewPromotion::where(['is_assesed' => TRUE, 'is_deleted' => FALSE])->get();
      return view('head_division/promotion/index', compact('datas'));
    }

    public function show($id)
    {
      $data=NewPromotion::where('id', $id)->first();
      $scores=NewPromotionScore::where('new_promotion_id', $id)->get();
      $files=NewPromotionFile::where('new_promotion_id', $id)->get();
      return view('head_division/promotion/show', compact('data', 'scores', 'files'));
    }
}
