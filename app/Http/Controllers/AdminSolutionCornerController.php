<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SolutionCorner;
use Validator;
use Alert;

class AdminSolutionCornerController extends Controller
{
  public function index()
  {
    $datas=SolutionCorner::where('is_deleted', FALSE)->get();
    return view('administrator/solutioncorner/index', compact('datas'));
  }

  public function destroy($id)
  {
    $data = SolutionCorner::findOrFail($id);
    $data->update([
        'is_deleted'            => TRUE
    ]);

    if($data){
          Alert::success('Berhasil', 'Pertemuan Berhasil Dihapus');
          return redirect()->back();
    } else {
          Alert::error('Gagal', 'Gagal Menghapus Pertemuan! Silahkan ulangi beberapa saat lagi');
          return redirect()->back();
    }
  }
}
