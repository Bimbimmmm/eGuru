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

class HeadOfficePersonalDataController extends Controller
{
  public function index()
  {
    $datas=PersonalData::all();
    return view('head_office/personaldata/index', compact('datas'));
  }

  public function show($id)
  {
    $user_id=User::where('personal_data_id', $id)->first();
    $data=PersonalData::where('id', $id)->first();
    $fehdatas=DataFormalEducationHistory::where(['user_id' => $id, 'is_deleted' => FALSE])->get();
    $nfehdatas=DataNonFormalEducationHistory::where(['user_id' => $id, 'is_deleted' => FALSE])->get();
    $rhdatas=DataRankHistory::where(['user_id' => $id, 'is_deleted' => FALSE])->get();
    $sihdatas=DataSalaryIncreaseHistory::where(['user_id' => $id, 'is_deleted' => FALSE])->get();
    $ahdatas=DataAppreciationHistory::where(['user_id' => $id, 'is_deleted' => FALSE])->get();
    $phdatas=DataPostionHistory::where(['user_id' => $id, 'is_deleted' => FALSE])->get();
    return view('head_office/personaldata/show', compact('data', 'fehdatas', 'nfehdatas', 'rhdatas', 'sihdatas', 'ahdatas', 'phdatas'));
  }
}
