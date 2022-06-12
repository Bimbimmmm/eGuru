<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewAssesmentCredit;
use App\Models\PersonalData;

class PrincipalCreditScoreController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      $data_cs=[];
      $pdid = auth()->user()->personal_data_id;
      $i=0;
      $pd=PersonalData::where('id', $pdid)->first();
      $datas=NewAssesmentCredit::where(['is_official_approve' => TRUE, 'is_deleted' => FALSE])->get();
      foreach ($datas as $data) {
        $dat=$data->user->personal_data_id;
        $p=PersonalData::where('id', $dat)->first();
        if($pd->work_unit_id == $p->work_unit_id){
          $data_cs[$i]=$data;
        }
        $i=$i+1;
      }
      $data_cs_count=count($data_cs);
      return view('principal/creditscore/index', compact('data_cs', 'data_cs_count'));
  }
}
