<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewAssesmentCredit;
use App\Models\NewAssesmentCreditScore;
use App\Models\NewAssesmentCreditScoreRejected;
use App\Models\ReferenceAssesmentCreditScoreActivity;
use App\Models\ReferenceEducationCreditScore;
use App\Models\NewPerformanceTarget;
use App\Models\NewPerformanceTargetScore;
use App\Models\ReferenceActivityCreditScore;
use App\Models\PersonalData;
use Validator;
use Alert;

class TeacherNewCreditScoreController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    $user_id = auth()->user()->id;
    $datas=NewAssesmentCredit::where(['user_id' => $user_id, 'is_deleted' => FALSE])->get();
    return view('teacher/creditscore/new/index', compact('datas'));
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    $user_id = auth()->user()->id;
    $performances=NewPerformanceTarget::where([
      'user_id' => $user_id,
      'is_official_approve' => TRUE,
      'is_correction' => FALSE,
      'is_deleted' => FALSE
      ])->get();
      $refeducations=ReferenceEducationCreditScore::all();
      return view('teacher/creditscore/new/create', compact('performances', 'refeducations'));
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request){

      $rules = [
        'new_performance_target_id'            => 'required',
        'reference_education_credit_score_id'  => 'required',
        'old_work_year'                        => 'required',
        'new_work_year'                        => 'required',
        'last_assessment_credit_score'         => 'required',
        'file'                                 => 'required',
        'file.*'                               => 'mimes:pdf|max:2048'
      ];

      $messages = [
        'new_performance_target_id.required'             => 'SKP Tahun Berjalan Wajib Dipilih',
        'reference_education_credit_score_id.required'   => 'Jenis Pendidikan wajib diisi',
        'old_work_year.required'                         => 'Masa Kerja Golongan Lama Wajib Diisi',
        'new_work_year.required'                         => 'Masa Kerja Golongan Baru Wajib Diisi',
        'last_assessment_credit_score.required'          => 'Jumlah Angka Kredit Tahun Lalu Wajib Diisi',
        'file.required'                                  => 'File PAK Tahun Lalu Wajib Diupload',
        'file.mimes'                                     => 'File wajib berekstensi .pdf'
      ];

      $validator = Validator::make($request->all(), $rules, $messages);

      if($validator->fails()){
        return redirect()->back()->withErrors($validator)->withInput($request->all);
      }

      $check=NewAssesmentCredit::where(['new_performance_target_id' => $request->new_performance_target_id, 'is_deleted' => FALSE])->count();
      if($check > 0){
        Alert::error('Gagal', 'SKP Tahun Berjalan Sudah Pernah Dibuatkan PAK!');
        return redirect()->route('teacherncs');
      }else{

        $original_name = $request->file->getClientOriginalName();
        $file = 'file_pak_tahun_lalu_' . time() . '_' . $original_name;
        $request->file->move(public_path('storage/creditscore'), $file);

        $user_id = auth()->user()->id;

        $data = new NewAssesmentCredit;
        $data->new_performance_target_id = $request->new_performance_target_id;
        $data->user_id = $user_id;
        $data->old_work_year = $request->old_work_year;
        $data->new_work_year = $request->new_work_year;
        $data->reference_education_credit_score_id = $request->reference_education_credit_score_id;
        $data->last_assessment_credit_score = $request->last_assessment_credit_score;
        $data->file = $file;
        $data->is_ready = FALSE;
        $data->is_finished = FALSE;
        $data->is_official_approve = FALSE;
        $data->is_deleted = FALSE;
        $save = $data->save();


        $get_performance_target_scores=NewPerformanceTargetScore::where('new_performance_target_id', $request->new_performance_target_id)->get();
        $get_assesment_credit=NewAssesmentCredit::where(['new_performance_target_id' => $request->new_performance_target_id, 'user_id' => $user_id])->first();

        $element_1=ReferenceAssesmentCreditScoreActivity::where('activity_item', 'Mengikuti pendidikan dan memperoleh gelar/ijazah/akta')->first();
        $element_3=ReferenceAssesmentCreditScoreActivity::where('activity_item', 'Melaksanakan proses pembelajaran')->first();
        $element_5=ReferenceAssesmentCreditScoreActivity::where('activity_item', 'Melaksanakan tugas lain yang relevan dengan fungsi sekolah')->first();
        $element_6=ReferenceAssesmentCreditScoreActivity::where('activity_item', 'Melaksanakan pengembangan diri')->first();
        $element_7=ReferenceAssesmentCreditScoreActivity::where('activity_item', 'Melaksanakan publikasi ilmiah')->first();
        $element_8=ReferenceAssesmentCreditScoreActivity::where('activity_item', 'Melaksanakan karya inovatif')->first();
        $element_9=ReferenceAssesmentCreditScoreActivity::where('activity_item', 'Memperoleh gelar/ijazah yang tidak sesuai dengan bidang yang diampuhnya')->first();
        $element_10=ReferenceAssesmentCreditScoreActivity::where('activity_item', 'Melaksanakan kegiatan yang mendukung tugas guru')->first();
        $element_11=ReferenceAssesmentCreditScoreActivity::where('activity_item', 'Perolehan penghargaan/tanda jasa Satya Lancana Karya Satya')->first();

        //Masukkan Nilai Unsur 1 Ke database assesment_credit_score
        $refeducation=ReferenceEducationCreditScore::where('id', $request->reference_education_credit_score_id)->first();

        $data_element_1 = new NewAssesmentCreditScore;
        $data_element_1->new_assesment_credit_id = $get_assesment_credit->id;
        $data_element_1->reference_assesment_credit_score_activity_id = $element_1->id;
        if($refeducation->is_adjustment == TRUE){
          $old=$refeducation->credit_score - 50.00;
          $data_element_1->old_credit_score = $old;
          $data_element_1->new_user_credit_score = 50.00;
          $data_element_1->total_user_credit_score = $refeducation->credit_score;
        }else{
          $data_element_1->old_credit_score = $refeducation->credit_score;
          $data_element_1->new_user_credit_score = 0;
          $data_element_1->total_user_credit_score = $refeducation->credit_score;
          $data_element_1->new_evaluator_credit_score = 0;
          $data_element_1->total_evaluator_credit_score = $refeducation->credit_score;
        }
        $save_elemet_1 = $data_element_1->save();

        //Masukkan Nilai Unsur 3 Code = 1-15
        //Masukkan Nilai Unsur 5 Code = 16-27
        //Masukkan Nilai Unsur 6 Code = 28-37
        //Masukkan Nilai Unsur 7 Code = 38-58
        //Masukkan Nilai Unsur 8 Code = 59-66
        //Masukkan Nilai Unsur 9 Code = 71-73
        //Masukkan Nilai Unsur 10 Code = 74-84
        //Masukkan Nilai Unsur 11 Code = 85-88
        $e3_credit_score=0;
        $e5_credit_score=0;
        $e6_credit_score=0;
        $e7_credit_score=0;
        $e8_credit_score=0;
        $e9_credit_score=0;
        $e10_credit_score=0;
        $e11_credit_score=0;

        foreach ($get_performance_target_scores as $get_performance_target_score) {
          if($get_performance_target_score->refPerformanceElement->code < 16){
            $e3_credit_score=$e3_credit_score+$get_performance_target_score->realization_credit_score;
          }elseif($get_performance_target_score->refPerformanceElement->code < 28){
            $e5_credit_score=$e5_credit_score+$get_performance_target_score->realization_credit_score;
          }elseif($get_performance_target_score->refPerformanceElement->code < 38){
            $e6_credit_score=$e6_credit_score+$get_performance_target_score->realization_credit_score;
          }elseif($get_performance_target_score->refPerformanceElement->code < 59){
            $e7_credit_score=$e7_credit_score+$get_performance_target_score->realization_credit_score;
          }elseif($get_performance_target_score->refPerformanceElement->code < 71){
            $e8_credit_score=$e8_credit_score+$get_performance_target_score->realization_credit_score;
          }elseif($get_performance_target_score->refPerformanceElement->code < 74){
            $e9_credit_score=$e9_credit_score+$get_performance_target_score->realization_credit_score;
          }elseif($get_performance_target_score->refPerformanceElement->code < 85){
            $e10_credit_score=$e10_credit_score+$get_performance_target_score->realization_credit_score;
          }elseif($get_performance_target_score->refPerformanceElement->code < 89){
            $e11_credit_score=$e11_credit_score+$get_performance_target_score->realization_credit_score;
          }
        }

        $data_element_3 = new NewAssesmentCreditScore;
        $data_element_3->new_assesment_credit_id = $get_assesment_credit->id;
        $data_element_3->reference_assesment_credit_score_activity_id = $element_3->id;
        $data_element_3->new_user_credit_score = $e3_credit_score;
        $save_elemet_3 = $data_element_3->save();

        if($e5_credit_score != 0){
          $data_element_5 = new NewAssesmentCreditScore;
          $data_element_5->new_assesment_credit_id = $get_assesment_credit->id;
          $data_element_5->reference_assesment_credit_score_activity_id = $element_5->id;
          $data_element_5->new_user_credit_score = $e5_credit_score;
          $save_elemet_5 = $data_element_5->save();
        }

        if($e6_credit_score != 0){
          $data_element_6 = new NewAssesmentCreditScore;
          $data_element_6->new_assesment_credit_id = $get_assesment_credit->id;
          $data_element_6->reference_assesment_credit_score_activity_id = $element_6->id;
          $data_element_6->new_user_credit_score = $e6_credit_score;
          $save_elemet_6 = $data_element_6->save();
        }

        if($e7_credit_score != 0){
          $data_element_7 = new NewAssesmentCreditScore;
          $data_element_7->new_assesment_credit_id = $get_assesment_credit->id;
          $data_element_7->reference_assesment_credit_score_activity_id = $element_7->id;
          $data_element_7->new_user_credit_score = $e7_credit_score;
          $save_elemet_7 = $data_element_7->save();
        }

        if($e8_credit_score != 0){
          $data_element_8 = new NewAssesmentCreditScore;
          $data_element_8->new_assesment_credit_id = $get_assesment_credit->id;
          $data_element_8->reference_assesment_credit_score_activity_id = $element_8->id;
          $data_element_8->new_user_credit_score = $e8_credit_score;
          $save_elemet_8 = $data_element_8->save();
        }

        if($e9_credit_score != 0){
          $data_element_9 = new NewAssesmentCreditScore;
          $data_element_9->new_assesment_credit_id = $get_assesment_credit->id;
          $data_element_9->reference_assesment_credit_score_activity_id = $element_9->id;
          $data_element_9->new_user_credit_score = $e9_credit_score;
          $save_elemet_9 = $data_element_9->save();
        }

        if($e10_credit_score != 0){
          $data_element_10 = new NewAssesmentCreditScore;
          $data_element_10->new_assesment_credit_id = $get_assesment_credit->id;
          $data_element_10->reference_assesment_credit_score_activity_id = $element_10->id;
          $data_element_10->new_user_credit_score = $e10_credit_score;
          $save_elemet_10 = $data_element_10->save();
        }

        if($e11_credit_score != 0){
          $data_element_11 = new NewAssesmentCreditScore;
          $data_element_11->new_assesment_credit_id = $get_assesment_credit->id;
          $data_element_11->reference_assesment_credit_score_activity_id = $element_11->id;
          $data_element_11->new_user_credit_score = $e11_credit_score;
          $save_elemet_11 = $data_element_11->save();
        }

        Alert::success('Berhasil', 'Pembuatan PAK Berhasil Dibuat');
        return redirect()->route('teacherncs');
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
      $assesment=NewAssesmentCredit::where('id', $id)->first();
      $datas=NewAssesmentCreditScore::where('new_assesment_credit_id' , $id)->orderBy('reference_assesment_credit_score_activity_id', 'asc')->get();
      return view('teacher/creditscore/new/show', compact('assesment', 'datas'));
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id, $idc)
    {
      $check=NewAssesmentCredit::where(['id'=> $idc, 'is_ready' => TRUE])->count();
      $data=NewAssesmentCreditScore::where('id' , $id)->first();
      if($check > 0){
        Alert::error('Gagal', 'Pengajuan PAK Sudah Dikunci!');
        return redirect()->back();
      }else{
        return view('teacher/creditscore/new/edit', compact('data', 'idc'));
      }
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id, $idc)
    {
      $data = NewAssesmentCreditScore::findOrFail($id);
      $total_user_credit_score=$data->new_user_credit_score+$request->old_credit_score;
      $data->update([
        'old_credit_score' => $request->old_credit_score,
        'total_user_credit_score' => $total_user_credit_score
      ]);

      if($data){
        Alert::success('Berhasil', 'Nilai Angka Kredit Lama Berhasil Ditambahkan');
        return redirect()->route('teacherncsshow', $idc);
      } else {
        Alert::error('Gagal', 'Gagal Menambahkan Angka Kredit Lama! Silahkan ulangi beberapa saat lagi');
        return redirect()->back();
      }
    }

    public function createold($id)
    {
      $check=NewAssesmentCredit::where(['id'=> $id, 'is_ready' => TRUE])->count();
      $activities=ReferenceAssesmentCreditScoreActivity::all();
      if($check > 0){
        Alert::error('Gagal', 'Pengajuan PAK Sudah Dikunci!');
        return redirect()->back();
      }else{
        return view('teacher/creditscore/new/oldactivity', compact('activities', 'id'));
      }
    }

    public function storeold(Request $request, $id)
    {
      $rules = [
        'reference_assesment_credit_score_activity_id'  => 'required',
        'last_assessment_credit_score'                  => 'required'
      ];

      $messages = [
        'reference_assesment_credit_score_activity_id.required'  => 'Kegiatan  Wajib Dipilih',
        'last_assessment_credit_score.required'                  => 'Angka Kredit wajib diisi'
      ];

      $validator = Validator::make($request->all(), $rules, $messages);

      if($validator->fails()){
        return redirect()->back()->withErrors($validator)->withInput($request->all);
      }

      $check=NewAssesmentCreditScore::where([
        'new_assesment_credit_id' => $id,
        'reference_assesment_credit_score_activity_id' => $request->reference_assesment_credit_score_activity_id
        ])->count();

        if($check > 0){
          Alert::error('Gagal', 'Kegiatan Sudah Ada!');
          return redirect()->back();
        }else{
          $data = new NewAssesmentCreditScore;
          $data->new_assesment_credit_id = $id;
          $data->reference_assesment_credit_score_activity_id = $request->reference_assesment_credit_score_activity_id;
          $data->old_credit_score = $request->last_assessment_credit_score;
          $data->new_user_credit_score = 0;
          $data->total_user_credit_score = $request->last_assessment_credit_score;
          $save = $data->save();

          Alert::success('Berhasil', 'Kegiatan PAK Lama Ditambahkan');
          return redirect()->route('teacherncsshow', $id);
        }
      }

      /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
      public function lock($id)
      {
        $data = NewAssesmentCredit::findOrFail($id);
        $data->update([
          'is_ready' => TRUE
        ]);

        if($data){
          Alert::success('Berhasil', 'Pengajuan PAK Berhasil Dikunci');
          return redirect()->route('teacherncs');
        } else {
          Alert::error('Gagal', 'Gagal Mengunci Pengajuan PAK! Silahkan ulangi beberapa saat lagi');
          return redirect()->back();
        }
      }

      public function pdf($id){
        $user = auth()->user()->registration_number;
        $get_assesment_credit_data=NewAssesmentCredit::where('id', $id)->first();
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

        $get_element_1=NewAssesmentCreditScore::where(['new_assesment_credit_id' => $id , 'reference_assesment_credit_score_activity_id' => $element_1->id])->first();
        $get_element_2=NewAssesmentCreditScore::where(['new_assesment_credit_id' => $id , 'reference_assesment_credit_score_activity_id' => $element_2->id])->first();
        $get_element_3=NewAssesmentCreditScore::where(['new_assesment_credit_id' => $id , 'reference_assesment_credit_score_activity_id' => $element_3->id])->first();
        $get_element_4=NewAssesmentCreditScore::where(['new_assesment_credit_id' => $id , 'reference_assesment_credit_score_activity_id' => $element_4->id])->first();
        $get_element_5=NewAssesmentCreditScore::where(['new_assesment_credit_id' => $id , 'reference_assesment_credit_score_activity_id' => $element_5->id])->first();
        $get_element_6=NewAssesmentCreditScore::where(['new_assesment_credit_id' => $id , 'reference_assesment_credit_score_activity_id' => $element_6->id])->first();
        $get_element_7=NewAssesmentCreditScore::where(['new_assesment_credit_id' => $id , 'reference_assesment_credit_score_activity_id' => $element_7->id])->first();
        $get_element_8=NewAssesmentCreditScore::where(['new_assesment_credit_id' => $id , 'reference_assesment_credit_score_activity_id' => $element_8->id])->first();
        $get_element_9=NewAssesmentCreditScore::where(['new_assesment_credit_id' => $id , 'reference_assesment_credit_score_activity_id' => $element_9->id])->first();
        $get_element_10=NewAssesmentCreditScore::where(['new_assesment_credit_id' => $id , 'reference_assesment_credit_score_activity_id' => $element_10->id])->first();
        $get_element_11=NewAssesmentCreditScore::where(['new_assesment_credit_id' => $id , 'reference_assesment_credit_score_activity_id' => $element_11->id])->first();

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

        $get_rejected_datas=NewAssesmentCreditScoreRejected::where('new_assesment_credit_id', $id)->get();
        return view('teacher/creditscore/new/pdf', compact('get_assesment_credit_data', 'arr_count1','arr_count2','arr_count3','arr_count4','arr_count5','arr_count6',
        'arr_count7','arr_count8','arr_count9','arr_count10','arr_count11', 'arr_main', 'arr_second', 'arr_all', 'assesorqrcode', 'get_rejected_datas'));
      }
    }
