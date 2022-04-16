<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LeavePermissions;
use Validator;
use Alert;

class AdminLeavePermissionController extends Controller
{
  public function index()
  {
    $datas=LeavePermissions::where('is_deleted', FALSE)->get();
    return view('administrator/leavepermission/index', compact('datas'));
  }

  public function destroy($id)
  {
    $data = LeavePermissions::findOrFail($id);
    $data->update([
        'is_deleted'            => TRUE
    ]);

    if($data){
          Alert::success('Berhasil', 'Cuti Berhasil Dihapus');
          return redirect()->back();
    } else {
          Alert::error('Gagal', 'Gagal Menghapus Cuti! Silahkan ulangi beberapa saat lagi');
          return redirect()->back();
    }
  }

}
