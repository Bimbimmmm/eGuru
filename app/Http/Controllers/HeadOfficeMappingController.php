<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PrincipalMapping;
use App\Models\PrincipalMappingFinish;
use Validator;
use Alert;

class HeadOfficeMappingController extends Controller
{
  public function index()
  {
    $datas=PrincipalMapping::where('is_deleted', FALSE)->get();
    return view('head_office/mapping/index', compact('datas'));
  }

  public function pdf($id)
  {
      $detail=PrincipalMapping::where('id', $id)->first();
      $datas=PrincipalMappingFinish::where('principal_mapping_id', $id)->get();
      $userqrcode="Nama : {$detail->user->personalData->name}\nNIP : {$detail->user->personalData->registration_number}\nUnit Kerja : {$detail->user->personalData->workUnit->name}";
      return view('head_office/mapping/pdf', compact('detail', 'datas', 'userqrcode'));
  }
}
