<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalaryIncrease;
use Validator;
use Alert;

class AdminSalaryIncreaseController extends Controller
{
  public function index()
  {
    $datas=SalaryIncrease::where('is_deleted', FALSE)->get();
    return view('administrator/salaryincrease/index', compact('datas'));
  }

  public function destroy($id)
  {
    $data = SalaryIncrease::findOrFail($id);
    $data->update([
        'is_deleted'            => TRUE
    ]);

    if($data){
          Alert::success('Berhasil', 'KGB Berhasil Dihapus');
          return redirect()->back();
    } else {
          Alert::error('Gagal', 'Gagal Menghapus KGB! Silahkan ulangi beberapa saat lagi');
          return redirect()->back();
    }
  }
}
