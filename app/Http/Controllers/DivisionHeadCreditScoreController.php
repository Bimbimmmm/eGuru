<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\AssesmentCredit;
use Validator;
use Alert;

class DivisionHeadCreditScoreController extends Controller
{
  public function index()
  {
    $datas=AssesmentCredit::where(['is_finished' => TRUE, 'is_official_approve' => FALSE])->get();
    return view('head_division/creditscore/index', compact('datas'));
  }

  public function show($id)
  {
    $assesment=AssesmentCredit::where('id', $id)->first();
    return view('head_division/creditscore/show', compact('assesment'));
  }

  public function lock(Request $request, $id)
  {
    DB::table('assesment_credit')->whereId($id)->update([
      'is_official_approve'  => TRUE
    ]);

    Alert::success('Berhasil', 'PAK Sudah Disetujui');
    return redirect()->route('divheadcr');
  }
}
