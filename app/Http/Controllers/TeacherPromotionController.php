<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promotion;
use App\Models\PromotionScore;
use App\Models\PromotionFile;
use App\Models\ReferencePromotionCreditScore;
use App\Models\ReferencePromotionFile;
use App\Models\ReferenceAssesmentCreditScoreActivity;
use App\Models\AssesmentCredit;
use App\Models\AssesmentCreditScore;
use Validator;
use Alert;

class TeacherPromotionController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    $user_id = auth()->user()->id;
    $datas=Promotion::where(['user_id' => $user_id, 'is_deleted' => FALSE])->get();
    return view('teacher/promotion/index', compact('datas'));
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    $user_id = auth()->user()->id;
    $assesments=AssesmentCredit::where(['user_id' => $user_id, 'is_official_approve' => TRUE, 'is_deleted' => FALSE])->get();
    $promotions=ReferencePromotionCreditScore::all();
    return view('teacher/promotion/create', compact('assesments', 'promotions'));
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
      'assesment_credit_id'                   => 'required',
      'reference_promotion_credit_score_id'   => 'required',
      'promotion_period'                      => 'required',
      'last_promotion_credit_score'           => 'required',
      'old_work_year'                         => 'required',
      'file'                                  => 'required',
      'file.*'                                => 'mimes:pdf|max:2048'
    ];

    $messages = [
      'assesment_credit_id.required'                    => 'PAK Terakhir Wajib Dipilih',
      'reference_promotion_credit_score_id.required'    => 'Usulan Golongan Wajib Dipilih',
      'promotion_period.required'                       => 'Periode KENPA Wajib Dipilih',
      'last_promotion_credit_score.required'            => 'Nilai PAK KENPA Terakhir Wajib Diisi',
      'old_work_year.required'                          => 'Masa Kerja Golongan Lama Wajib Diisi',
      'file.required'                                   => 'File PAK KENPA Terakhir Wajib Diupload',
      'file.mimes'                                      => 'File wajib berekstensi .pdf'
    ];

    $validator = Validator::make($request->all(), $rules, $messages);

    if($validator->fails()){
      return redirect()->back()->withErrors($validator)->withInput($request->all);
    }

    $user_id = auth()->user()->id;

    $check=Promotion::where(['assesment_credit_id' => $request->assesment_credit_id, 'promotion_period' => $request->promotion_period, 'is_deleted' => FALSE])->count();
    if($check > 0){
      Alert::error('Gagal', 'PAK Terakhir Sudah Pernah Diajukan!');
      return redirect()->route('teachercs');
    }else{

      $original_name = $request->file->getClientOriginalName();
      $file = 'file_pak_kenpa_lama_' . time() . '_' . $original_name;
      $request->file->move(public_path('storage/promotion'), $file);

      $data = new Promotion;
      $data->reference_promotion_credit_score_id = $request->reference_promotion_credit_score_id;
      $data->user_id = $user_id;
      $data->promotion_period = $request->promotion_period;
      $data->assesment_credit_id = $request->assesment_credit_id;
      $data->last_promotion_credit_score = $request->last_promotion_credit_score;
      $data->old_work_year = $request->old_work_year;
      $data->file = $file;
      $data->is_locked = FALSE;
      $data->is_finish = FALSE;
      $data->is_rejected = FALSE;
      $data->is_deleted = FALSE;
      $save = $data->save();

      $get=Promotion::where(['assesment_credit_id' => $request->assesment_credit_id, 'promotion_period' => $request->promotion_period, 'user_id' => $user_id])->first();

      $getfiles=ReferencePromotionFile::all();

      foreach($getfiles as $getfile){
        $file = new PromotionFile;
        $file->promotion_id = $get->id;
        $file->reference_promotion_file_id = $getfile->id;
        $save2= $file->save();
      }

      $getasscores=AssesmentCreditScore::where('assesment_credit_id', $request->assesment_credit_id)->get();

      foreach($getasscores as $getasscore){
        $proscr = new PromotionScore;
        $proscr->promotion_id = $get->id;
        $proscr->reference_assesment_credit_score_activity_id = $getasscore->reference_assesment_credit_score_activity_id;
        $proscr->new_credit_score = $getasscore->total_evaluator_credit_score;
        $save3= $proscr->save();
      }

      Alert::success('Berhasil', 'Pengajuan KENPA Berhasil Dibuat');
      return redirect()->route('teacherpm');
    }
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {
    $data=Promotion::where('id', $id)->first();
    $files=PromotionFile::where('promotion_id', $id)->get();
    $scores=PromotionScore::where('promotion_id', $id)->get();
    return view('teacher/promotion/show', compact('data', 'files', 'scores'));
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($id, $pmid)
  {
    $data=PromotionScore::where('id', $id)->first();
    return view('teacher/promotion/edit', compact('data', 'pmid'));
  }

  public function upload($id, $pmid)
  {
    $data=PromotionFile::where('id', $id)->first();
    return view('teacher/promotion/upload', compact('data', 'pmid'));
  }

  public function uploadfile(Request $request, $id, $pmid)
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
    $file = 'file_berkas_kenpa_'. $reg_num . time() . '_' . $original_name;
    $request->file->move(public_path('storage/promotion/completeness'), $file);

    $data = PromotionFile::findOrFail($id);
    $data->update([
      'file' => $file
    ]);

    $check=PromotionFile::where('id', $id)->first();

    if($check->file != NULL){
      Alert::success('Berhasil', 'File Kelengkapan Berkas Berhasil Diupload');
      return redirect()->route('teacherpmshow', $pmid);
    }else{
      Alert::error('Gagal', 'Periksa Kembali File Yang Anda Masukkan');
      return redirect()->back();
    }
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request, $id, $pmid)
  {
    $rules = [
      'old_credit_score'    => 'required'
    ];

    $messages = [
      'old_credit_score.required'  => 'Angka Kredit Lama Wajib Dimasukkan'
    ];

    $validator = Validator::make($request->all(), $rules, $messages);

    if($validator->fails()){
      return redirect()->back()->withErrors($validator)->withInput($request->all);
    }

    $data = PromotionScore::findOrFail($id);
    if($data->new_credit_score >= $request->old_credit_score){
      $get_credit_score=$data->new_credit_score-$request->old_credit_score;
      $data->update([
        'old_credit_score' => $request->old_credit_score,
        'get_credit_score' => $get_credit_score
      ]);
      Alert::success('Berhasil', 'Nilai Angka Kredit Lama Berhasil Ditambahkan');
      return redirect()->route('teacherpmshow', $pmid);
    }else{
      Alert::error('Gagal', 'Periksa Kembali Angka Kredit Yang Anda Masukkan');
      return redirect()->back();
    }
  }

  public function oldactivity($id)
  {
    $activities=ReferenceAssesmentCreditScoreActivity::all();
    return view('teacher/promotion/oldactivity', compact('activities', 'id'));
  }

  public function storeold(Request $request, $id)
  {
    $rules = [
      'reference_assesment_credit_score_activity_id'    => 'required',
      'old_credit_score'                                => 'required'
    ];

    $messages = [
      'reference_assesment_credit_score_activity_id.required'   => 'Jenis Kegiatan Wajib Dimasukkan',
      'old_credit_score.required'                               => 'Angka Kredit Lama Wajib Dimasukkan'
    ];

    $validator = Validator::make($request->all(), $rules, $messages);

    if($validator->fails()){
      return redirect()->back()->withErrors($validator)->withInput($request->all);
    }

    $check=PromotionScore::where(['promotion_id' => $id, 'reference_assesment_credit_score_activity_id' => $request->reference_assesment_credit_score_activity_id])->count();

    if($check > 0){
      Alert::error('Gagal', 'Kegiatan Telah Ada!');
      return redirect()->back();
    }else{
      $data = new PromotionScore;
      $data->promotion_id = $id;
      $data->reference_assesment_credit_score_activity_id = $request->reference_assesment_credit_score_activity_id;
      $data->old_credit_score = $request->old_credit_score;
      $data->new_credit_score = 0;
      $data->get_credit_score = 0;
      $save= $data->save();

      if($save){
        Alert::success('Berhasil', 'Kegiatan Lama Telah Ditambahkan');
        return redirect()->route('teacherpmshow', $id);
      }else{
        Alert::error('Gagal', 'Periksa Kembali Kegiatan Yang Anda Masukkan');
        return redirect()->back();
      }
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
    $data = PromotionScore::findOrFail($id);
    $data->update([
      'old_credit_score' => NULL,
      'get_credit_score' => NULL
    ]);
    Alert::success('Berhasil', 'Nilai Telah Direset');
    return redirect()->back();
  }

  public function lock($id)
  {

    $gets=PromotionFile::where(['promotion_id' => $id, 'file' => NULL])->get();

    foreach ($gets as $get) {
      $file = PromotionFile::find($get->id);
      $file->delete();
    }

    $data = Promotion::findOrFail($id);
    $data->update([
      'is_locked' => TRUE
    ]);

    Alert::success('Berhasil', 'Pengajuan Telah Dikunci');
    return redirect()->route('teacherpm');
  }
}
