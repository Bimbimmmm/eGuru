<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewAssesmentCredit;

class HeadOfficeCreditScoreController extends Controller
{
  public function index()
  {
    $datas=NewAssesmentCredit::where(['is_official_approve' => TRUE, 'is_deleted' => FALSE])->get();
    return view('head_office/creditscore/index', compact('datas'));
  }

  public function show($id)
  {
    $assesment=NewAssesmentCredit::where('id', $id)->first();
    return view('head_office/creditscore/show', compact('assesment'));
  }
}
