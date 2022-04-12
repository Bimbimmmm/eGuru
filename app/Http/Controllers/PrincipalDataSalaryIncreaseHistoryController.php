<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataSalaryIncreaseHistory;
use App\Models\ReferenceRanks;
use Validator;
use Alert;

class PrincipalDataSalaryIncreaseHistoryController extends Controller
{
  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      $ranks=ReferenceRanks::all();
      return view('principal/personaldata/datahistory/salaryincrease/create', compact('ranks'));
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
        'number_of_decree'    => 'required',
        'starting_from_date'  => 'required',
        'last_rank'           => 'required',
        'last_salary'         => 'required',
        'new_salary'          => 'required',
        'issued_by'           => 'required',
        'file.*'              => 'mimes:pdf|max:2048'
      ];

      $messages = [
        'number_of_decree.required'     => 'Nomor SK Wajib Diisi',
        'starting_from_date.required'   => 'T.M.T Wajib Diisi',
        'last_rank.required'            => 'Pangkat/Golongan Wajib Diisi',
        'last_salary.required'          => 'Gaji Lama Wajib Diisi',
        'new_salary.required'           => 'Gaji Baru Wajib Diisi',
        'issued_by.required'            => 'Nama Instansi Wajib Diisi',
        'file.required'                 => 'File SK Wajib Diupload',
        'file.mimes'                    => 'File SK Wajib Berekstensi .pdf'
      ];

      $validator = Validator::make($request->all(), $rules, $messages);

      if($validator->fails()){
        return redirect()->back()->withErrors($validator)->withInput($request->all);
      }

      $starting_from_date = date("Y-m-d", strtotime($request->starting_from_date));

      $original_name = $request->file->getClientOriginalName();
      $file = 'file_kgb_' . time() . '_' . $original_name;
      $request->file->move(public_path('storage/datahistory/salaryincrease'), $file);


      $user_id = auth()->user()->id;

      $data = new DataSalaryIncreaseHistory;
      $data->number_of_decree = $request->number_of_decree;
      $data->starting_from_date = $starting_from_date;
      $data->last_rank = $request->last_rank;
      $data->last_salary = $request->last_salary;
      $data->new_salary = $request->new_salary;
      $data->issued_by = $request->issued_by;
      $data->file = $file;
      $data->user_id = $user_id;
      $data->is_deleted = FALSE;
      $save = $data->save();

      if($save){
        Alert::success('Berhasil', 'Riwayat KGB Berhasil Disimpan');
        return redirect()->route('principalpd');
      } else {
        Alert::error('Gagal', 'Gagal Menyimpan Riwayat KGB! Silahkan Ulangi Beberapa Saat Lagi');
        return redirect()->route('principalpdsihcr');
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
      $data = DataSalaryIncreaseHistory::findOrFail($id);
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
