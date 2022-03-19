<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\SalaryIncrease;
use App\Models\SalaryIncreaseFile;
use App\Models\ReferenceSalaryIncreaseFile;
use Validator;
use Alert;

class HeadOfficeSalaryIncreaseController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    $datas=SalaryIncrease::where(['is_locked' => TRUE, 'is_finish' => FALSE, 'is_rejected' => FALSE, 'is_deleted' => FALSE])->get();
    return view('head_office/salaryincrease/index', compact('datas'));
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {
    $data=SalaryIncrease::where('id', $id)->first();
    $files=SalaryIncreaseFile::where('salary_increase_id', $id)->get();
    return view('head_office/salaryincrease/show', compact('data', 'files'));
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function approve($id)
  {
    DB::table('salary_increase')->whereId($id)->update([
      'is_finish'        => TRUE
    ]);

    Alert::success('Berhasil', 'Pengajuan Kenaikan Gaji Berkala Diterima');
    return redirect()->route('officeheadsi');
  }

  public function reject(Request $request, $id)
  {
    $rules = [
      'reason' => 'required'
    ];

    $messages = [
      'reason.required' => 'Alasan Penolakan Wajib Diisi'
    ];

    $validator = Validator::make($request->all(), $rules, $messages);

    if($validator->fails()){
      return redirect()->back()->withErrors($validator)->withInput($request->all);
    }

    DB::table('salary_increase')->whereId($id)->update([
      'is_rejected'      => TRUE,
      'rejected_reason'  => $request->reason
    ]);

    Alert::success('Berhasil', 'Pengajuan Kenaikan Gaji Berkala Ditolak');
    return redirect()->route('officeheadsi');
  }
}
