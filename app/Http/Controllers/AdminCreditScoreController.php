<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AssesmentCredit;
use Validator;
use Alert;


class AdminCreditScoreController extends Controller
{
  public function index()
  {
    $datas=AssesmentCredit::where('is_deleted', FALSE)->get();
    return view('administrator/creditscore/index', compact('datas'));
  }

  public function destroy($id)
  {
    $data = AssesmentCredit::findOrFail($id);
    $data->update([
        'is_deleted'            => TRUE
    ]);

    if($data){
          Alert::success('Berhasil', 'PAK Berhasil Dihapus');
          return redirect()->back();
    } else {
          Alert::error('Gagal', 'Gagal Menghapus PAK! Silahkan ulangi beberapa saat lagi');
          return redirect()->back();
    }
  }

}
