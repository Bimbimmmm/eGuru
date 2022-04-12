<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataFormalEducationHistory;
use Carbon\Carbon;
use Validator;
use Alert;

class PrincipalDataFormalEducationHistoryController extends Controller
{
  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      return view('principal/personaldata/datahistory/formaleducation/create');
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
        'education_level'   => 'required',
        'name'              => 'required',
        'start_date'        => 'required',
        'graduation_date'   => 'required',
        'place'             => 'required',
        'diploma_number'    => 'required',
        'file.*'            => 'mimes:pdf|max:2048'
      ];

      $messages = [
        'education_level.required'    => 'Jenjang Pendidikan Wajib Diisi',
        'name.required'               => 'Nama Sekolah Wajib Diisi',
        'start_date.required'         => 'Tanggal Mulai Sekolah Wajib Diisi',
        'graduation_date.required'    => 'Tanggal Lulus Sekolah Wajib Diisi',
        'place.required'              => 'Lokasi Sekolah Wajib Diisi',
        'diploma_number.required'     => 'Nomor Ijazah Wajib Diisi',
        'file.required'               => 'File Ijazah Wajib Diupload',
        'file.mimes'                  => 'File Ijazah Wajib Berekstensi .pdf'
      ];

      $validator = Validator::make($request->all(), $rules, $messages);

      if($validator->fails()){
        return redirect()->back()->withErrors($validator)->withInput($request->all);
      }

      $start_date = date("Y-m-d", strtotime($request->start_date));
      $graduation_date = date("Y-m-d", strtotime($request->graduation_date));


      $original_name = $request->file->getClientOriginalName();
      $file = 'file_ijazah_pendidikan_formal_' . time() . '_' . $original_name;
      $request->file->move(public_path('storage/datahistory/formaleducation'), $file);


      $user_id = auth()->user()->id;

      $data = new DataFormalEducationHistory;
      $data->education_level = $request->education_level;
      $data->name = $request->name;
      $data->start_date = $start_date;
      $data->graduation_date = $graduation_date;
      $data->place = $request->place;
      $data->diploma_number = $request->diploma_number;
      $data->file = $file;
      $data->user_id = $user_id;
      $data->is_deleted = FALSE;
      $save = $data->save();

      if($save){
        Alert::success('Berhasil', 'Riwayat Pendidikan Formal Berhasil Disimpan');
        return redirect()->route('principalpd');
      } else {
        Alert::error('Gagal', 'Gagal Menyimpan Riwayat Pendidikan Formal! Silahkan Ulangi Beberapa Saat Lagi');
        return redirect()->route('principalpdfehcr');
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
      $data = DataFormalEducationHistory::findOrFail($id);
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
