<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalaryIncrease;
use App\Models\SalaryIncreaseFile;
use App\Models\ReferenceSalaryIncreaseFile;
use App\Models\DecreeNumber;
use Validator;
use Alert;
use Carbon\Carbon;

class TeacherSalaryIncreaseController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    $user_id = auth()->user()->id;
    $datas=SalaryIncrease::where(['user_id' => $user_id, 'is_deleted' => FALSE])->get();
    return view('teacher/salaryincrease/index', compact('datas'));
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    return view('teacher/salaryincrease/create');
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
      'year' => 'required',
      'type' => 'required',
      'old_salary' => 'required',
      'old_decree_date' => 'required',
      'old_decree_number' => 'required',
      'old_date' => 'required',
      'old_work_year' => 'required'
    ];

    $messages = [
      'year.required'  => 'Tahun Pengajuan KGB Wajib Dipilih',
      'type.required'  => 'Tipe KGB Wajib Dipilih',
      'old_salary.required' => 'Gaji Lama Wajib Dimasukkan',
      'old_decree_date.required' => 'Tanggal SK Lama Wajib Dimasukkan',
      'old_decree_number.required' => 'Nomor SK Lama Wajib Dimasukkan',
      'old_date.required' => 'T.M.T Lama Wajib Dimasukkan',
      'old_work_year.required' => 'Masa Kerja Golongan Lama Wajib Dimasukkan'
    ];

    $validator = Validator::make($request->all(), $rules, $messages);

    if($validator->fails()){
      return redirect()->back()->withErrors($validator)->withInput($request->all);
    }

    $user_id = auth()->user()->id;

    $check=SalaryIncrease::where(['year' => $request->year, 'is_deleted' => FALSE])->count();

    if($check > 0){
      Alert::error('Gagal', 'KGB Sudah Pernah Diajukan!');
      return redirect()->route('teachersi');
    }else{

      $old_date=Carbon::parse($request->old_date);
      $old_decree_date=Carbon::parse($request->old_decree_date);

      $data = new SalaryIncrease;
      $data->year = $request->year;
      $data->type = $request->type;
      $data->old_salary = $request->old_salary;
      $data->old_decree_date = $old_decree_date;
      $data->old_decree_number = $request->old_decree_number;
      $data->old_date = $old_date;
      $data->old_work_year = $request->old_work_year;
      $data->user_id = $user_id;
      $data->is_locked = FALSE;
      $data->is_finish = FALSE;
      $data->is_rejected = FALSE;
      $data->is_deleted = FALSE;
      $save = $data->save();

      $get=SalaryIncrease::where(['year' => $request->year, 'user_id' => $user_id])->first();

      if($request->type == "Non-Mutasi"){
        $getfiles=ReferenceSalaryIncreaseFile::where('is_mutation', FALSE)->get();
      }else{
        $getfiles=ReferenceSalaryIncreaseFile::all();
      }
      foreach($getfiles as $getfile){
        $file = new SalaryIncreaseFile;
        $file->salary_increase_id = $get->id;
        $file->reference_salary_increase_file_id = $getfile->id;
        $save2= $file->save();
      }
    }

    Alert::success('Berhasil', 'Pengajuan KENPA Berhasil Dibuat');
    return redirect()->route('teachersi');
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
    return view('teacher/salaryincrease/show', compact('data', 'files'));
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function upload($id, $siid)
  {
    $data=SalaryIncreaseFile::where('id', $id)->first();
    return view('teacher/salaryincrease/upload', compact('data', 'siid'));
  }

  public function uploadfile(Request $request, $id, $siid)
  {
    $rules = [
      'file'    => 'required',
      'file.*'  => 'mimes:pdf|max:2048'
    ];

    $messages = [
      'file.required'  => 'File Wajib Diupload',
      'file.mimes'     => 'File wajib berekstensi .pdf'
    ];

    $validator = Validator::make($request->all(), $rules, $messages);

    if($validator->fails()){
      return redirect()->back()->withErrors($validator)->withInput($request->all);
    }

    $reg_num = auth()->user()->registration_number;

    $original_name = $request->file->getClientOriginalName();
    $file = 'file_berkas_kgb_'. $reg_num . time() . '_' . $original_name;
    $request->file->move(public_path('storage/salaryincrease'), $file);

    $data = SalaryIncreaseFile::findOrFail($id);
    $data->update([
      'file' => $file
    ]);

    $check=SalaryIncreaseFile::where('id', $id)->first();

    if($check->file != NULL){
      Alert::success('Berhasil', 'File Berhasil Diupload');
      return redirect()->route('teachersishow', $siid);
    }else{
      Alert::error('Gagal', 'Periksa Kembali File Yang Anda Masukkan');
      return redirect()->back();
    }
  }

  public function lock($id)
  {
    $gets=SalaryIncreaseFile::where(['salary_increase_id' => $id, 'file' => NULL])->get();

    foreach ($gets as $get) {
      $file = SalaryIncreaseFile::find($get->id);
      $file->delete();
    }

    $data = SalaryIncrease::findOrFail($id);
    $data->update([
      'is_locked' => TRUE
    ]);

    Alert::success('Berhasil', 'Pengajuan KGB Telah Dikunci');
    return redirect()->route('teachersi');
  }

  public function pdf($id)
  {
    $data=SalaryIncrease::where('id', $id)->first();
    $get_decree_number=DecreeNumber::where('salary_increase_id', $id)->first();
    $decree_head=str_pad($get_decree_number->id, 4, '0', STR_PAD_LEFT);
    $next_tmt=date('Y', strtotime('+2 year', strtotime( $data->new_date )));
    $officialqrcode="Nama Lengkap : Jafar Sidik, SE. | NIP : NIP. 19620815 198602 1 005 | Pembina Utama Muda | Kepala Dinas";
    return view('teacher/salaryincrease/pdf', compact('data', 'decree_head', 'get_decree_number', 'next_tmt', 'officialqrcode'));
  }
}
