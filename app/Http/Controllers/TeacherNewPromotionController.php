<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewPromotion;
use App\Models\NewPromotionScore;
use App\Models\NewPromotionFile;
use App\Models\ReferencePromotionCreditScore;
use App\Models\ReferencePromotionFile;
use App\Models\ReferenceAssesmentCreditScoreActivity;
use App\Models\NewAssesmentCredit;
use App\Models\NewAssesmentCreditScore;
use App\Models\PersonalData;
use App\Models\ReferenceRanks;
use Validator;
use Alert;


class TeacherNewPromotionController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    $user_id = auth()->user()->id;
    $datas=NewPromotion::where(['user_id' => $user_id, 'is_deleted' => FALSE])->get();
    return view('teacher/promotion/new/index', compact('datas'));
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    $user_id = auth()->user()->id;
    $assesments=NewAssesmentCredit::where(['user_id' => $user_id, 'is_official_approve' => TRUE, 'is_deleted' => FALSE])->get();
    $promotions=ReferencePromotionCreditScore::all();
    return view('teacher/promotion/new/create', compact('assesments', 'promotions'));
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
      'new_assesment_credit_id'               => 'required',
      'reference_promotion_credit_score_id'   => 'required',
      'promotion_period'                      => 'required',
      'last_promotion_credit_score'           => 'required',
      'old_work_year'                         => 'required',
      'file'                                  => 'required',
      'file.*'                                => 'mimes:pdf|max:2048'
    ];

    $messages = [
      'new_assesment_credit_id.required'                => 'PAK Terakhir Wajib Dipilih',
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

    $check=NewPromotion::where(['new_assesment_credit_id' => $request->new_assesment_credit_id, 'promotion_period' => $request->promotion_period, 'is_deleted' => FALSE])->count();
    if($check > 0){
      Alert::error('Gagal', 'PAK Terakhir Sudah Pernah Diajukan!');
      return redirect()->route('teachernpm');
    }else{

      $original_name = $request->file->getClientOriginalName();
      $file = 'file_pak_kenpa_lama_' . time() . '_' . $original_name;
      $request->file->move(public_path('storage/promotion'), $file);

      $data = new NewPromotion;
      $data->reference_promotion_credit_score_id = $request->reference_promotion_credit_score_id;
      $data->user_id = $user_id;
      $data->promotion_period = $request->promotion_period;
      $data->new_assesment_credit_id = $request->new_assesment_credit_id;
      $data->last_promotion_credit_score = $request->last_promotion_credit_score;
      $data->old_work_year = $request->old_work_year;
      $data->file = $file;
      $data->is_locked = FALSE;
      $data->is_assesed = FALSE;
      $data->is_finish = FALSE;
      $data->is_rejected = FALSE;
      $data->is_deleted = FALSE;
      $save = $data->save();

      $get=NewPromotion::where(['new_assesment_credit_id' => $request->new_assesment_credit_id, 'promotion_period' => $request->promotion_period, 'user_id' => $user_id])->first();

      $getfiles=ReferencePromotionFile::all();

      foreach($getfiles as $getfile){
        $file = new NewPromotionFile;
        $file->new_promotion_id = $get->id;
        $file->reference_promotion_file_id = $getfile->id;
        $save2= $file->save();
      }

      $getasscores=NewAssesmentCreditScore::where('new_assesment_credit_id', $request->new_assesment_credit_id)->get();

      foreach($getasscores as $getasscore){
        $proscr = new NewPromotionScore;
        $proscr->new_promotion_id = $get->id;
        $proscr->reference_assesment_credit_score_activity_id = $getasscore->reference_assesment_credit_score_activity_id;
        if($getasscore->refAsCSActivity->activity_item != "Mengikuti pendidikan dan memperoleh gelar/ijazah/akta"){
          $proscr->new_credit_score = $getasscore->total_evaluator_credit_score;
        }else{
          $proscr->old_credit_score = $getasscore->total_evaluator_credit_score;
          $proscr->new_credit_score = 0;
          $proscr->get_credit_score = $getasscore->total_evaluator_credit_score;
        }
        $save3= $proscr->save();
      }

      Alert::success('Berhasil', 'Pengajuan KENPA Berhasil Dibuat');
      return redirect()->route('teachernpm');
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
    $data=NewPromotion::where('id', $id)->first();
    $files=NewPromotionFile::where('new_promotion_id', $id)->get();
    $scores=NewPromotionScore::where('new_promotion_id', $id)->get();
    return view('teacher/promotion/new/show', compact('data', 'files', 'scores'));
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($id, $pmid)
  {
    $data=NewPromotionScore::where('id', $id)->first();
    return view('teacher/promotion/new/edit', compact('data', 'pmid'));
  }

  public function upload($id, $pmid)
  {
    $data=NewPromotionFile::where('id', $id)->first();
    return view('teacher/promotion/new/upload', compact('data', 'pmid'));
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
    $request->file->move(public_path('storage/promotion/new/completeness'), $file);

    $data = NewPromotionFile::findOrFail($id);
    $data->update([
      'file' => $file
    ]);

    $check=NewPromotionFile::where('id', $id)->first();

    if($check->file != NULL){
      Alert::success('Berhasil', 'File Kelengkapan Berkas Berhasil Diupload');
      return redirect()->route('teachernpmshow', $pmid);
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

    $data = NewPromotionScore::findOrFail($id);
    if($data->new_credit_score >= $request->old_credit_score){
      $get_credit_score=$data->new_credit_score-$request->old_credit_score;
      $data->update([
        'old_credit_score' => $request->old_credit_score,
        'get_credit_score' => $get_credit_score
      ]);
      Alert::success('Berhasil', 'Nilai Angka Kredit Lama Berhasil Ditambahkan');
      return redirect()->route('teachernpmshow', $pmid);
    }else{
      Alert::error('Gagal', 'Periksa Kembali Angka Kredit Yang Anda Masukkan');
      return redirect()->back();
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
    $data = NewPromotionScore::findOrFail($id);
    $data->update([
      'old_credit_score' => NULL,
      'get_credit_score' => NULL
    ]);
    Alert::success('Berhasil', 'Nilai Telah Direset');
    return redirect()->back();
  }

  public function lock($id)
  {

    $gets=NewPromotionFile::where(['new_promotion_id' => $id, 'file' => NULL])->get();

    foreach ($gets as $get) {
      $file = NewPromotionFile::find($get->id);
      $file->delete();
    }

    $data = NewPromotion::findOrFail($id);
    $data->update([
      'is_locked' => TRUE
    ]);

    Alert::success('Berhasil', 'Pengajuan Telah Dikunci');
    return redirect()->route('teachernpm');
  }

  public function pdf($id){
    $promotion=NewPromotion::where('id', $id)->first();
    $ref=ReferencePromotionCreditScore::where('id', $promotion->reference_promotion_credit_score_id)->first();
    $promotion_rank=ReferenceRanks::where('group', $ref->promotion_rank)->first();
    $year=$promotion->assementCredit->performanceTarget->assessment_year;
    $nyear=$year + 1;

    $user = auth()->user()->registration_number;
    $get_assesment_credit_data=NewAssesmentCredit::where('id', $promotion->new_assesment_credit_id)->first();
    $personal_data=PersonalData::where('registration_number', $user)->first();

    $element_1=ReferenceAssesmentCreditScoreActivity::where('activity_item', 'Mengikuti pendidikan dan memperoleh gelar/ijazah/akta')->first();
    $element_2=ReferenceAssesmentCreditScoreActivity::where('activity_item', 'Mengikuti pelatihan prajabatan')->first();
    $element_3=ReferenceAssesmentCreditScoreActivity::where('activity_item', 'Melaksanakan proses pembelajaran')->first();
    $element_4=ReferenceAssesmentCreditScoreActivity::where('activity_item', 'Melaksanakan proses bimbingan')->first();
    $element_5=ReferenceAssesmentCreditScoreActivity::where('activity_item', 'Melaksanakan tugas lain yang relevan dengan fungsi sekolah')->first();
    $element_6=ReferenceAssesmentCreditScoreActivity::where('activity_item', 'Melaksanakan pengembangan diri')->first();
    $element_7=ReferenceAssesmentCreditScoreActivity::where('activity_item', 'Melaksanakan publikasi ilmiah')->first();
    $element_8=ReferenceAssesmentCreditScoreActivity::where('activity_item', 'Melaksanakan karya inovatif')->first();
    $element_9=ReferenceAssesmentCreditScoreActivity::where('activity_item', 'Memperoleh gelar/ijazah yang tidak sesuai dengan bidang yang diampuhnya')->first();
    $element_10=ReferenceAssesmentCreditScoreActivity::where('activity_item', 'Melaksanakan kegiatan yang mendukung tugas guru')->first();
    $element_11=ReferenceAssesmentCreditScoreActivity::where('activity_item', 'Perolehan penghargaan/tanda jasa Satya Lancana Karya Satya')->first();

    $get_element_1=NewAssesmentCreditScore::where(['new_assesment_credit_id' => $promotion->new_assesment_credit_id , 'reference_assesment_credit_score_activity_id' => $element_1->id])->first();
    $get_element_2=NewAssesmentCreditScore::where(['new_assesment_credit_id' => $promotion->new_assesment_credit_id , 'reference_assesment_credit_score_activity_id' => $element_2->id])->first();
    $get_element_3=NewAssesmentCreditScore::where(['new_assesment_credit_id' => $promotion->new_assesment_credit_id , 'reference_assesment_credit_score_activity_id' => $element_3->id])->first();
    $get_element_4=NewAssesmentCreditScore::where(['new_assesment_credit_id' => $promotion->new_assesment_credit_id , 'reference_assesment_credit_score_activity_id' => $element_4->id])->first();
    $get_element_5=NewAssesmentCreditScore::where(['new_assesment_credit_id' => $promotion->new_assesment_credit_id , 'reference_assesment_credit_score_activity_id' => $element_5->id])->first();
    $get_element_6=NewAssesmentCreditScore::where(['new_assesment_credit_id' => $promotion->new_assesment_credit_id , 'reference_assesment_credit_score_activity_id' => $element_6->id])->first();
    $get_element_7=NewAssesmentCreditScore::where(['new_assesment_credit_id' => $promotion->new_assesment_credit_id , 'reference_assesment_credit_score_activity_id' => $element_7->id])->first();
    $get_element_8=NewAssesmentCreditScore::where(['new_assesment_credit_id' => $promotion->new_assesment_credit_id , 'reference_assesment_credit_score_activity_id' => $element_8->id])->first();
    $get_element_9=NewAssesmentCreditScore::where(['new_assesment_credit_id' => $promotion->new_assesment_credit_id , 'reference_assesment_credit_score_activity_id' => $element_9->id])->first();
    $get_element_10=NewAssesmentCreditScore::where(['new_assesment_credit_id' => $promotion->new_assesment_credit_id , 'reference_assesment_credit_score_activity_id' => $element_10->id])->first();
    $get_element_11=NewAssesmentCreditScore::where(['new_assesment_credit_id' => $promotion->new_assesment_credit_id , 'reference_assesment_credit_score_activity_id' => $element_11->id])->first();

    if($get_element_1 != null){
      $count1=$get_element_1->new_evaluator_credit_score;
      $old_count1=$get_element_1->old_credit_score;
      $total_ecs1=$get_element_1->total_evaluator_credit_score;
      $arr_count1=[$count1,$old_count1,$total_ecs1];
    }else{
      $count1=0;
      $old_count1=0;
      $total_ecs1=0;
      $arr_count1=[$count1,$old_count1,$total_ecs1];
    }

    if($get_element_2 != null){
      $count2=$get_element_2->new_evaluator_credit_score;
      $old_count2=$get_element_2->old_credit_score;
      $total_ecs2=$get_element_2->total_evaluator_credit_score;
      $arr_count2=[$count2,$old_count2,$total_ecs2];
    }else{
      $count2=0;
      $old_count2=0;
      $total_ecs2=0;
      $arr_count2=[$count2,$old_count2,$total_ecs2];
    }

    if($get_element_3 != null){
      $count3=$get_element_3->new_evaluator_credit_score;
      $old_count3=$get_element_3->old_credit_score;
      $total_ecs3=$get_element_3->total_evaluator_credit_score;
      $arr_count3=[$count3,$old_count3,$total_ecs3];
    }else{
      $count3=0;
      $old_count3=0;
      $total_ecs3=0;
      $arr_count3=[$count3,$old_count3,$total_ecs3];
    }

    if($get_element_4 != null){
      $count4=$get_element_4->new_evaluator_credit_score;
      $old_count4=$get_element_4->old_credit_score;
      $total_ecs4=$get_element_4->total_evaluator_credit_score;
      $arr_count4=[$count4,$old_count4,$total_ecs4];
    }else{
      $count4=0;
      $old_count4=0;
      $total_ecs4=0;
      $arr_count4=[$count4,$old_count4,$total_ecs4];
    }

    if($get_element_5 != null){
      $count5=$get_element_5->new_evaluator_credit_score;
      $old_count5=$get_element_5->old_credit_score;
      $total_ecs5=$get_element_5->total_evaluator_credit_score;
      $arr_count5=[$count5,$old_count5,$total_ecs5];
    }else{
      $count5=0;
      $old_count5=0;
      $total_ecs5=0;
      $arr_count5=[$count5,$old_count5,$total_ecs5];
    }

    if($get_element_6 != null){
      $count6=$get_element_6->new_evaluator_credit_score;
      $old_count6=$get_element_6->old_credit_score;
      $total_ecs6=$get_element_6->total_evaluator_credit_score;
      $arr_count6=[$count6,$old_count6,$total_ecs6];
    }else{
      $count6=0;
      $old_count6=0;
      $total_ecs6=0;
      $arr_count6=[$count6,$old_count6,$total_ecs6];
    }

    if($get_element_7 != null){
      $count7=$get_element_7->new_evaluator_credit_score;
      $old_count7=$get_element_7->old_credit_score;
      $total_ecs7=$get_element_7->total_evaluator_credit_score;
      $arr_count7=[$count7,$old_count7,$total_ecs7];
    }else{
      $count7=0;
      $old_count7=0;
      $total_ecs7=0;
      $arr_count7=[$count7,$old_count7,$total_ecs7];
    }

    if($get_element_8 != null){
      $count8=$get_element_8->new_evaluator_credit_score;
      $old_count8=$get_element_8->old_credit_score;
      $total_ecs8=$get_element_8->total_evaluator_credit_score;
      $arr_count8=[$count8,$old_count8,$total_ecs8];
    }else{
      $count8=0;
      $old_count8=0;
      $total_ecs8=0;
      $arr_count8=[$count8,$old_count8,$total_ecs8];
    }

    if($get_element_9 != null){
      $count9=$get_element_9->new_evaluator_credit_score;
      $old_count9=$get_element_9->old_credit_score;
      $total_ecs9=$get_element_9->total_evaluator_credit_score;
      $arr_count9=[$count9,$old_count9,$total_ecs9];
    }else{
      $count9=0;
      $old_count9=0;
      $total_ecs9=0;
      $arr_count9=[$count9,$old_count9,$total_ecs9];
    }

    if($get_element_10 != null){
      $count10=$get_element_10->new_evaluator_credit_score;
      $old_count10=$get_element_10->old_credit_score;
      $total_ecs10=$get_element_10->total_evaluator_credit_score;
      $arr_count10=[$count10,$old_count10,$total_ecs10];
    }else{
      $count10=0;
      $old_count10=0;
      $total_ecs10=0;
      $arr_count10=[$count10,$old_count10,$total_ecs10];
    }

    if($get_element_11 != null){
      $count11=$get_element_11->new_evaluator_credit_score;
      $old_count11=$get_element_11->old_credit_score;
      $total_ecs11=$get_element_11->total_evaluator_credit_score;
      $arr_count11=[$count11,$old_count11,$total_ecs11];
    }else{
      $count11=0;
      $old_count11=0;
      $total_ecs11=0;
      $arr_count11=[$count11,$old_count11,$total_ecs11];
    }

    (float)$count_new_main_element=$count1+$count2+$count3+$count4+$count5+$count6+$count7+$count8;
    (float)$count_old_main_element=$old_count1+$old_count2+$old_count3+$old_count4+$old_count5+$old_count6+$old_count7+$old_count8;
    (float)$total_main_element=$total_ecs1+$total_ecs2+$total_ecs3+$total_ecs4+$total_ecs5+$total_ecs6+$total_ecs7+$total_ecs8;
    $arr_main=[$count_old_main_element,$count_new_main_element,$total_main_element];
    (float)$count_new_second_element=$count9+$count10+$count11;
    (float)$count_old_second_element=$old_count9+$old_count10+$old_count11;
    (float)$total_second_element=$total_ecs9+$total_ecs10+$total_ecs11;
    $arr_second=[$count_old_second_element,$count_new_second_element,$total_second_element];
    (float)$count_old_all=$count_old_main_element+$count_old_second_element;
    (float)$count_new_all=$count_new_main_element+$count_new_second_element;
    (float)$count_total_all=$total_main_element+$total_second_element;
    $arr_all=[$count_old_all, $count_new_all, $count_total_all];

    $assesorqrcode="Nama Lengkap : Jafar Sidik, SE. | NIP : NIP. 19620815 198602 1 005 | Pembina Utama Muda | Kepala Dinas";

    return view('teacher/promotion/new/pdf', compact('get_assesment_credit_data', 'arr_count1','arr_count2','arr_count3','arr_count4','arr_count5','arr_count6',
    'arr_count7','arr_count8','arr_count9','arr_count10','arr_count11', 'arr_main', 'arr_second', 'arr_all', 'assesorqrcode', 'promotion', 'promotion_rank', 'nyear'));
  }
}
