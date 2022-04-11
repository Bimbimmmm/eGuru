<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataAppreciationHistory;
use Validator;
use Alert;

class TeacherDataAppreciationHistoryController extends Controller
{
  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      return view('teacher/personaldata/datahistory/appreciation/create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
      $rules = [
        'name'        => 'required',
        'year'        => 'required',
        'issued_by'   => 'required',
        'file.*'      => 'mimes:pdf|max:2048'
      ];

      $messages = [
        'name.required'         => 'Nama Penghargaan Wajib Diisi',
        'year.required'         => 'Tahun Penghargaan Wajib Diisi',
        'issued_by.required'    => 'Nama Instansi Wajib Diisi',
        'file.required'         => 'File Penghargaan Wajib Diupload',
        'file.mimes'            => 'File Penghargaan Wajib Berekstensi .pdf'
      ];

      $validator = Validator::make($request->all(), $rules, $messages);

      if($validator->fails()){
        return redirect()->back()->withErrors($validator)->withInput($request->all);
      }

      $original_name = $request->file->getClientOriginalName();
      $file = 'file_penghargaan_' . time() . '_' . $original_name;
      $request->file->move(public_path('storage/datahistory/appreciation'), $file);


      $user_id = auth()->user()->id;

      $data = new DataAppreciationHistory;
      $data->name = $request->name;
      $data->year = $request->year;
      $data->issued_by = $request->issued_by;
      $data->file = $file;
      $data->user_id = $user_id;
      $data->is_deleted = FALSE;
      $save = $data->save();

      if($save){
        Alert::success('Berhasil', 'Riwayat Penghargaan Berhasil Disimpan');
        return redirect()->route('teacherpd');
      } else {
        Alert::error('Gagal', 'Gagal Menyimpan Riwayat Penghargaan! Silahkan Ulangi Beberapa Saat Lagi');
        return redirect()->route('teacherpdahcr');
      }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
      $data = DataAppreciationHistory::findOrFail($id);
      $data->update([
          'is_deleted' => TRUE
      ]);

      if($data){
            Alert::success('Berhasil', 'Riwayat Berhasil Dihapus');
            return redirect()->back();
      } else {
            Alert::error('Gagal', 'Gagal Menghapus Riwayat! Silahkan ulangi beberapa saat lagi');
            return redirect()->back();
      }
  }
}
