<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PrincipalMapping;
use App\Models\PrincipalMappingSubject;
use App\Models\PrincipalMappingTeacher;
use App\Models\PrincipalMappingFinish;
use App\Models\PersonalData;
use App\Models\ReferenceSubject;
use App\Models\User;
use Validator;
use Alert;

class DivisionHeadMappingController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $datas=PrincipalMapping::where(['is_finish' => TRUE, 'is_deleted' => FALSE])->get();
    return view('head_division/mapping/index', compact('datas'));
  }

  public function pdf($id)
  {
      $detail=PrincipalMapping::where('id', $id)->first();
      $datas=PrincipalMappingFinish::where('principal_mapping_id', $id)->get();
      $userqrcode="Nama : {$detail->user->personalData->name}\nNIP : {$detail->user->personalData->registration_number}\nUnit Kerja : {$detail->user->personalData->workUnit->name}";
      return view('head_division/mapping/pdf', compact('detail', 'datas', 'userqrcode'));
  }
}
