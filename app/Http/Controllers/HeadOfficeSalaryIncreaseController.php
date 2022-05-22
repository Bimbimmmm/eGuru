<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\SalaryIncrease;
use App\Models\SalaryIncreaseFile;
use App\Models\ReferenceSalaryIncreaseFile;
use App\Models\DecreeNumber;
use Validator;
use Alert;
use Carbon\Carbon;

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
    $all_datas=SalaryIncrease::where(['is_deleted' => FALSE])->get();
    return view('head_office/salaryincrease/index', compact('datas', 'all_datas'));
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
  public function approve(Request $request, $id)
  {
    $rules = [
      'new_salary' => 'required',
      'new_work_year' => 'required',
      'new_date' => 'required'
    ];

    $messages = [
      'new_salary.required' => 'Gaji Pokok Baru Wajib Diisi',
      'new_work_year.required' => 'Masa Kerja Golongan Baru Wajib Diisi',
      'new_date.required' => 'T.M.T Baru Wajib Diisi'
    ];

    $validator = Validator::make($request->all(), $rules, $messages);

    if($validator->fails()){
      return redirect()->back()->withErrors($validator)->withInput($request->all);
    }

    date_default_timezone_set('Asia/Makassar');
    $month=date('m');
    $year=date('Y');
    $month_decree= "null";
    if($month === 1){
      $month_decree="I";
    }else if($month == 2){
      $month_decree="II";
    }else if($month == 3){
      $month_decree="III";
    }else if($month == 4){
      $month_decree="IV";
    }else if($month == 5){
      $month_decree="V";
    }else if($month == 6){
      $month_decree="VI";
    }else if($month == 7){
      $month_decree="VII";
    }else if($month == 8){
      $month_decree="VIII";
    }else if($month == 9){
      $month_decree="IX";
    }else if($month == 10){
      $month_decree="X";
    }else if($month == 11){
      $month_decree="XI";
    }else if($month == 12){
      $month_decree="XII";
    }

    $name = auth()->user()->personalData->name;

    $data = new DecreeNumber;
    $data->type = "Surat Pengajuan Kenaikan Gaji Berkala";
    $data->salary_increase_id = $id;
    $data->month = $month_decree;
    $data->year = $year;
    $data->assesed_by = $name;
    $save = $data->save();

    $new_date=Carbon::parse($request->new_date);

    DB::table('salary_increase')->whereId($id)->update([
      'is_finish'     => TRUE,
      'new_salary'    => $request->new_salary,
      'new_work_year' => $request->new_work_year,
      'new_date'      => $new_date
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
