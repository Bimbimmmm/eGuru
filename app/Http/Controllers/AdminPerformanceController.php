<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewPerformanceTarget;
use Validator;
use Alert;

class AdminPerformanceController extends Controller
{
  public function index()
  {
    $datas=NewPerformanceTarget::where('is_deleted', FALSE)->get();
    return view('administrator/performance/index', compact('datas'));
  }

  public function destroy($id)
  {
    $data = NewPerformanceTarget::findOrFail($id);
    $data->update([
        'is_deleted'            => TRUE
    ]);

    if($data){
          Alert::success('Berhasil', 'KENPA Berhasil Dihapus');
          return redirect()->back();
    } else {
          Alert::error('Gagal', 'Gagal Menghapus KENPA! Silahkan ulangi beberapa saat lagi');
          return redirect()->back();
    }
  }
}
