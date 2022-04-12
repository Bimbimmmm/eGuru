<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataRankHistory;
use App\Models\ReferenceRanks;
use Validator;
use Alert;

class PrincipalDataRankHistoryController extends Controller
{
  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      $ranks=ReferenceRanks::all();
      return view('principal/personaldata/datahistory/rank/create', compact('ranks'));
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
        'last_rank'           => 'required',
        'last_group'          => 'required',
        'starting_from_date'  => 'required',
        'number_of_decree'    => 'required',
        'decree_date'         => 'required',
        'file.*'              => 'mimes:pdf|max:2048'
      ];

      $messages = [
        'last_rank.required'            => 'Pangkat Wajib Diisi',
        'last_group.required'           => 'Golongan Wajib Diisi',
        'starting_from_date.required'   => 'T.M.T Wajib Diisi',
        'number_of_decree.required'     => 'Nomor SK Wajib Diisi',
        'decree_date.required'          => 'Tanggal SK Wajib Diisi',
        'file.required'                 => 'File SK Wajib Diupload',
        'file.mimes'                    => 'File SK Wajib Berekstensi .pdf'
      ];

      $validator = Validator::make($request->all(), $rules, $messages);

      if($validator->fails()){
        return redirect()->back()->withErrors($validator)->withInput($request->all);
      }

      $starting_from_date = date("Y-m-d", strtotime($request->starting_from_date));
      $decree_date = date("Y-m-d", strtotime($request->decree_date));

      $original_name = $request->file->getClientOriginalName();
      $file = 'file_kenaikan_pangkat_' . time() . '_' . $original_name;
      $request->file->move(public_path('storage/datahistory/rank'), $file);


      $user_id = auth()->user()->id;

      $data = new DataRankHistory;
      $data->last_rank = $request->last_rank;
      $data->last_group = $request->last_group;
      $data->starting_from_date = $starting_from_date;
      $data->number_of_decree = $request->number_of_decree;
      $data->decree_date = $decree_date;
      $data->file = $file;
      $data->user_id = $user_id;
      $data->is_deleted = FALSE;
      $save = $data->save();

      if($save){
        Alert::success('Berhasil', 'Riwayat Kepangkatan Berhasil Disimpan');
        return redirect()->route('principalpd');
      } else {
        Alert::error('Gagal', 'Gagal Menyimpan Riwayat Kepangkatan! Silahkan Ulangi Beberapa Saat Lagi');
        return redirect()->route('principalpdrhcr');
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
      $data = DataRankHistory::findOrFail($id);
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
