<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PersonalData;
use App\Models\DataFormalEducationHistory;
use App\Models\DataNonFormalEducationHistory;
use App\Models\DataPostionHistory;
use App\Models\DataRankHistory;
use App\Models\DataSalaryIncreaseHistory;
use App\Models\DataAppreciationHistory;
use Validator;
use Alert;

class PrincipalPersonalDataController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      $reg = auth()->user()->registration_number;
      $id = auth()->user()->personal_data_id;
      $user_id = auth()->user()->id;
      $data=PersonalData::where(['registration_number' => $reg, 'id' => $id])->first();
      $fehdatas=DataFormalEducationHistory::where(['user_id' => $user_id, 'is_deleted' => FALSE])->get();
      $nfehdatas=DataNonFormalEducationHistory::where(['user_id' => $user_id, 'is_deleted' => FALSE])->get();
      $rhdatas=DataRankHistory::where(['user_id' => $user_id, 'is_deleted' => FALSE])->get();
      $sihdatas=DataSalaryIncreaseHistory::where(['user_id' => $user_id, 'is_deleted' => FALSE])->get();
      $ahdatas=DataAppreciationHistory::where(['user_id' => $user_id, 'is_deleted' => FALSE])->get();
      $phdatas=DataPostionHistory::where(['user_id' => $user_id, 'is_deleted' => FALSE])->get();
      return view('principal/personaldata/index', compact('data', 'fehdatas', 'nfehdatas', 'rhdatas', 'sihdatas', 'ahdatas', 'phdatas'));
  }
}
