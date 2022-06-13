<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewPromotion;
use Validator;
use Alert;

class AdminPromotionController extends Controller
{
  public function index()
  {
    $datas=NewPromotion::where('is_deleted', FALSE)->get();
    return view('administrator/promotion/index', compact('datas'));
  }

  public function destroy($id)
  {
    $data = NewPromotion::findOrFail($id);
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
