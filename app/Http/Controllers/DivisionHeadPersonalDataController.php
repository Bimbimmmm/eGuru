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
use App\Models\User;
use Validator;
use Alert;

class DivisionHeadPersonalDataController extends Controller
{
  public function index(){
    $datas=PersonalData::all();
    return view('head_division/personaldata/index', compact('datas'));
  }

  public function show($id)
  {
      $user=User::where('personal_data_id', $id)->first();
      $data=PersonalData::where(['registration_number' => $user->registration_number, 'id' => $user->personal_data_id])->first();
      $fehdatas=DataFormalEducationHistory::where(['user_id' => $user->id, 'is_deleted' => FALSE])->get();
      $nfehdatas=DataNonFormalEducationHistory::where(['user_id' => $user->id, 'is_deleted' => FALSE])->get();
      $rhdatas=DataRankHistory::where(['user_id' => $user->id, 'is_deleted' => FALSE])->get();
      $sihdatas=DataSalaryIncreaseHistory::where(['user_id' => $user->id, 'is_deleted' => FALSE])->get();
      $ahdatas=DataAppreciationHistory::where(['user_id' => $user->id, 'is_deleted' => FALSE])->get();
      $phdatas=DataPostionHistory::where(['user_id' => $user->id, 'is_deleted' => FALSE])->get();
      return view('head_division/personaldata/show', compact('data', 'fehdatas', 'nfehdatas', 'rhdatas', 'sihdatas', 'ahdatas', 'phdatas'));
  }
}
