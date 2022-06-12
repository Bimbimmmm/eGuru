<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewPromotion;
use App\Models\PersonalData;

class PrincipalPromotionController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      $data_pr=[];
      $pdid = auth()->user()->personal_data_id;
      $i=0;
      $pd=PersonalData::where('id', $pdid)->first();
      $datas=NewPromotion::where(['is_finish' => TRUE, 'is_deleted' => FALSE])->get();
      foreach ($datas as $data) {
        $dat=$data->user->personal_data_id;
        $p=PersonalData::where('id', $dat)->first();
        if($pd->work_unit_id == $p->work_unit_id){
          $data_pr[$i]=$data;
        }
        $i=$i+1;
      }
      $data_pr_count=count($data_pr);
      return view('principal/promotion/index', compact('data_pr', 'data_pr_count'));
  }
}
