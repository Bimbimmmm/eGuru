<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataNonFormalEducationHistory;
use Validator;
use Alert;

class PrincipalDataNonFormalEducationHistoryController extends Controller
{
  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      return view('principal/personaldata/datahistory/nonformaleducation/create');
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
        'name'                => 'required',
        'graduation_date'     => 'required',
        'place'               => 'required',
        'certificate_number'  => 'required',
        'file.*'              => 'mimes:pdf|max:2048'
      ];

      $messages = [
        'name.required'                 => 'Nama Lembaga Wajib Diisi',
        'graduation_date.required'      => 'Tanggal Lulus Pendidikan Wajib Diisi',
        'place.required'                => 'Lokasi Lembaga Wajib Diisi',
        'certificate_number.required'   => 'Nomor Sertifikat Wajib Diisi',
        'file.required'                 => 'File Sertifikat Wajib Diupload',
        'file.mimes'                    => 'File Sertifikat Wajib Berekstensi .pdf'
      ];

      $validator = Validator::make($request->all(), $rules, $messages);

      if($validator->fails()){
        return redirect()->back()->withErrors($validator)->withInput($request->all);
      }

      $graduation_date = date("Y-m-d", strtotime($request->graduation_date));

      $original_name = $request->file->getClientOriginalName();
      $file = 'file_sertifikat_pendidikan_non_formal_' . time() . '_' . $original_name;
      $request->file->move(public_path('storage/datahistory/nonformaleducation'), $file);


      $user_id = auth()->user()->id;

      $data = new DataNonFormalEducationHistory;
      $data->name = $request->name;
      $data->graduation_date = $graduation_date;
      $data->place = $request->place;
      $data->certificate_number = $request->certificate_number;
      $data->file = $file;
      $data->user_id = $user_id;
      $data->is_deleted = FALSE;
      $save = $data->save();

      if($save){
        Alert::success('Berhasil', 'Riwayat Pendidikan Non-Formal Berhasil Disimpan');
        return redirect()->route('principalpd');
      } else {
        Alert::error('Gagal', 'Gagal Menyimpan Riwayat Pendidikan Non-Formal! Silahkan Ulangi Beberapa Saat Lagi');
        return redirect()->route('principalpdnfehcr');
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
      $data = DataNonFormalEducationHistory::findOrFail($id);
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
