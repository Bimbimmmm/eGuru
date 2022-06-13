<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PrincipalMapping;
use Validator;
use Alert;


class AdminMappingController extends Controller
{
  public function index()
  {
    $datas=PrincipalMapping::where('is_deleted', FALSE)->get();
    return view('administrator/mapping/index', compact('datas'));
  }

  public function destroy($id)
  {
    $data = PrincipalMapping::findOrFail($id);
    $data->update([
        'is_deleted'            => TRUE
    ]);

    if($data){
          Alert::success('Berhasil', 'Pemetaan Guru Berhasil Dihapus');
          return redirect()->back();
    } else {
          Alert::error('Gagal', 'Gagal Menghapus Pemetaan Guru! Silahkan ulangi beberapa saat lagi');
          return redirect()->back();
    }
  }
}
