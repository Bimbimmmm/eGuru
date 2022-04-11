<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataPostionHistory;
use App\Models\ReferencePositions;
use Validator;
use Alert;

class TeacherDataPositionHistoryController extends Controller
{
  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      $positions=ReferencePositions::all();
      return view('teacher/personaldata/datahistory/position/create', compact('positions'));
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
        'position'                => 'required',
        'start_date'              => 'required',
        'end_date'                => 'required',
        'reference_position_id'   => 'required',
        'starting_from_date'      => 'required',
        'number_of_decree'        => 'required',
        'file.*'                  => 'mimes:pdf|max:2048'
      ];

      $messages = [
        'position.required'               => 'Nama Jabatan Wajib Diisi',
        'start_date.required'             => 'Tanggal Mulai Wajib Diisi',
        'end_date.required'               => 'Tanggal Selesai Wajib Diisi',
        'reference_position_id.required'  => 'Jenis Jabatan Wajib Diisi',
        'starting_from_date.required'     => 'T.M.T Wajib Diisi',
        'number_of_decree.required'       => 'Nomor SK Wajib Diisi',
        'file.required'                   => 'File SK Wajib Diupload',
        'file.mimes'                      => 'File SK Wajib Berekstensi .pdf'
      ];

      $validator = Validator::make($request->all(), $rules, $messages);

      if($validator->fails()){
        return redirect()->back()->withErrors($validator)->withInput($request->all);
      }

      $starting_from_date = date("Y-m-d", strtotime($request->starting_from_date));
      $start_date = date("Y-m-d", strtotime($request->start_date));
      $end_date = date("Y-m-d", strtotime($request->end_date));

      $original_name = $request->file->getClientOriginalName();
      $file = 'file_jabatan_' . time() . '_' . $original_name;
      $request->file->move(public_path('storage/datahistory/position'), $file);


      $user_id = auth()->user()->id;

      $data = new DataPostionHistory;
      $data->position = $request->position;
      $data->start_date = $start_date;
      $data->end_date = $end_date;
      $data->reference_position_id = $request->reference_position_id;
      $data->starting_from_date = $starting_from_date;
      $data->number_of_decree = $request->number_of_decree;
      $data->file = $file;
      $data->user_id = $user_id;
      $data->is_deleted = FALSE;
      $save = $data->save();

      if($save){
        Alert::success('Berhasil', 'Riwayat Jabatan Berhasil Disimpan');
        return redirect()->route('teacherpd');
      } else {
        Alert::error('Gagal', 'Gagal Menyimpan Riwayat Jabatan! Silahkan Ulangi Beberapa Saat Lagi');
        return redirect()->route('teacherpdphcr');
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
      $data = DataPostionHistory::findOrFail($id);
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
