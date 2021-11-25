<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AssesmentCredit;
use App\Models\AssesmentCreditScore;
use App\Models\ReferenceAssesmentCreditScoreActivity;
use App\Models\ReferenceEducationCreditScore;
use App\Models\PerformanceTarget;
use App\Models\PerformanceTargetScore;
use App\Models\ReferenceActivityCreditScore;
use Validator;
use Alert;

class TeacherCreditScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $datas=AssesmentCredit::where(['user_id' => $user_id, 'is_deleted' => FALSE])->get();
        return view('teacher/creditscore/index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_id = auth()->user()->id;
        $performances=PerformanceTarget::where([
          'user_id' => $user_id,
          'is_official_approve' => TRUE,
          'is_correction' => FALSE,
          'is_deleted' => FALSE
        ])->get();
        $refeducations=ReferenceEducationCreditScore::all();
        return view('teacher/creditscore/create', compact('performances', 'refeducations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request){
       $rules = [
           'performance_target_id'                => 'required',
           'reference_education_credit_score_id'  => 'required',
           'old_work_year'                        => 'required',
           'new_work_year'                        => 'required',
           'last_assessment_credit_score'         => 'required',
           'file'                                 => 'required',
           'file.*'                               => 'mimes:pdf|max:2048'
       ];

       $messages = [
           'performance_target_id.required'                 => 'SKP Tahun Berjalan Wajib Dipilih',
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

       $check=AssesmentCredit::where(['performance_target_id' => $request->performance_target_id, 'is_deleted' => FALSE])->count();
       if($check > 0){
         Alert::error('Gagal', 'SKP Tahun Berjalan Sudah Pernah Dibuatkan PAK!');
         return redirect()->route('teachercs');
       }else{

         $original_name = $request->file->getClientOriginalName();
         $file = 'file_pak_tahun_lalu_' . time() . '_' . $original_name;
         $request->file->move(public_path('storage/creditscore'), $file);

         $user_id = auth()->user()->id;

         $data = new AssesmentCredit;
         $data->performance_target_id = $request->performance_target_id;
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

         $get_performance_target_scores=PerformanceTargetScore::where('performance_target_id', $request->performance_target_id)->get();
         $get_elements_1=ReferenceActivityCreditScore::where('activity_item', 'Mengikuti pendidikan dan memperoleh gelar/ijazah/akta')->get();
         $get_elements_2=ReferenceActivityCreditScore::where('activity_item', 'Mengikuti pelatihan prajabatan')->get();
         $get_elements_3=ReferenceActivityCreditScore::where('activity_item', 'Melaksanakan proses pembelajaran')->get();
         $get_elements_4=ReferenceActivityCreditScore::where('activity_item', 'Melaksanakan proses bimbingan')->get();
         $get_elements_5=ReferenceActivityCreditScore::where('activity_item', 'Melaksanakan tugas lain yang relevan dengan fungsi sekolah')->get();
         $get_elements_6=ReferenceActivityCreditScore::where('activity_item', 'Melaksanakan pengembangan diri')->get();
         $get_elements_7=ReferenceActivityCreditScore::where('activity_item', 'Melaksanakan publikasi ilmiah')->get();
         $get_elements_8=ReferenceActivityCreditScore::where('activity_item', 'Melaksanakan karya inovatif')->get();
         $get_elements_9=ReferenceActivityCreditScore::where('activity_item', 'Memperoleh gelar/ijazah yang tidak sesuai dengan bidang yang diampuhnya')->get();
         $get_elements_10=ReferenceActivityCreditScore::where('activity_item', 'Melaksanakan kegiatan yang mendukung tugas guru')->get();
         $get_elements_11=ReferenceActivityCreditScore::where('activity_item', 'Perolehan penghargaan/tanda jasa Satya Lancana Karya Satya')->get();

         $get_assesment_credit=AssesmentCredit::where(['performance_target_id' => $request->performance_target_id, 'user_id' => $user_id])->first();
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
         //Masukkan Nilai Unsur 1 Ke database assesment_credit_score
         $refeducation=ReferenceEducationCreditScore::where('id', $request->reference_education_credit_score_id)->first();

         $data_element_1 = new AssesmentCreditScore;
         $data_element_1->assesment_credit_id = $get_assesment_credit->id;
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

         //Masukkan Nilai Unsur 2 Ke database assesment_credit_score
         foreach ($get_elements_2 as $get_element_2) {
             foreach ($get_performance_target_scores as $get_performance_target_score) {
                 if($get_element_2->id == $get_performance_target_score->reference_activity_credit_score_id){
                     $data_element_2 = new AssesmentCreditScore;
                     $data_element_2->assesment_credit_id = $get_assesment_credit->id;
                     $data_element_2->reference_assesment_credit_score_activity_id = $element_2->id;
                     $data_element_2->new_user_credit_score = $get_performance_target_score->realization_credit_score;
                     $save_elemet_2 = $data_element_2->save();
                 }
             }
         }
         //Masukkan Nilai Unsur 3 Ke database assesment_credit_score
         foreach ($get_elements_3 as $get_element_3) {
             foreach ($get_performance_target_scores as $get_performance_target_score) {
                 if($get_element_3->id == $get_performance_target_score->reference_activity_credit_score_id){
                   $data_element_3 = new AssesmentCreditScore;
                   $data_element_3->assesment_credit_id = $get_assesment_credit->id;
                   $data_element_3->reference_assesment_credit_score_activity_id = $element_3->id;
                   $data_element_3->new_user_credit_score = $get_performance_target_score->realization_credit_score;
                   $save_elemet_3 = $data_element_3->save();
                 }
             }
         }
         //Masukkan Nilai Unsur 4 Ke database assesment_credit_score
         foreach ($get_elements_4 as $get_element_4) {
             foreach ($get_performance_target_scores as $get_performance_target_score) {
                 if($get_element_4->id == $get_performance_target_score->reference_activity_credit_score_id){
                   $data_element_4 = new AssesmentCreditScore;
                   $data_element_4->assesment_credit_id = $get_assesment_credit->id;
                   $data_element_4->reference_assesment_credit_score_activity_id = $element_4->id;
                   $data_element_4->new_user_credit_score = $get_performance_target_score->realization_credit_score;
                   $save_elemet_4 = $data_element_4->save();
                 }
             }
         }
         //Masukkan Nilai Unsur 5 Ke database assesment_credit_score
         $user_credit_score5=0;
         $element5=0;
         foreach ($get_elements_5 as $get_element_5) {
             foreach ($get_performance_target_scores as $get_performance_target_score) {
                 if($get_element_5->id == $get_performance_target_score->reference_activity_credit_score_id){
                     $element5=$element_5->id;
                     $user_credit_score5=$user_credit_score5+$get_performance_target_score->realization_credit_score;
                 }
             }
         }
         if($element5 != 0){
             $data_element_5 = new AssesmentCreditScore;
             $data_element_5->assesment_credit_id = $get_assesment_credit->id;
             $data_element_5->reference_assesment_credit_score_activity_id = $element5;
             $data_element_5->new_user_credit_score = $user_credit_score5;
             $save_elemet_5 = $data_element_5->save();
         }
         //Masukkan Nilai Unsur 6 Ke database assesment_credit_score
         $user_credit_score6=0;
         $element6=0;
         foreach ($get_elements_6 as $get_element_6) {
             foreach ($get_performance_target_scores as $get_performance_target_score) {
                 if($get_element_6->id == $get_performance_target_score->reference_activity_credit_score_id){
                     $element6=$element_6->id;
                     $user_credit_score6=$user_credit_score6+$get_performance_target_score->realization_credit_score;
                 }
             }
         }
         if($element6 != 0){
           $data_element_6 = new AssesmentCreditScore;
           $data_element_6->assesment_credit_id = $get_assesment_credit->id;
           $data_element_6->reference_assesment_credit_score_activity_id = $element6;
           $data_element_6->new_user_credit_score = $user_credit_score6;
           $save_elemet_6 = $data_element_6->save();
         }
         //Masukkan Nilai Unsur 7 Ke database assesment_credit_score
         $user_credit_score7=0;
         $element7=0;
         foreach ($get_elements_7 as $get_element_7) {
             foreach ($get_performance_target_scores as $get_performance_target_score) {
                 if($get_element_7->id == $get_performance_target_score->reference_activity_credit_score_id){
                     $element7=$element_7->id;
                     $user_credit_score7=$user_credit_score7+$get_performance_target_score->realization_credit_score;
                 }
             }
         }
         if($element7 != 0){
           $data_element_7 = new AssesmentCreditScore;
           $data_element_7->assesment_credit_id = $get_assesment_credit->id;
           $data_element_7->reference_assesment_credit_score_activity_id = $element7;
           $data_element_7->new_user_credit_score = $user_credit_score7;
           $save_elemet_7 = $data_element_7->save();
         }
         //Masukkan Nilai Unsur 8 Ke database assesment_credit_score
         $user_credit_score8=0;
         $element8=0;
         foreach ($get_elements_8 as $get_element_8) {
             foreach ($get_performance_target_scores as $get_performance_target_score) {
                 if($get_element_8->id == $get_performance_target_score->reference_activity_credit_score_id){
                     $element8=$element_8->id;
                     $user_credit_score8=$user_credit_score8+$get_performance_target_score->realization_credit_score;
                 }
             }
         }
         if($element8 != 0){
           $data_element_8 = new AssesmentCreditScore;
           $data_element_8->assesment_credit_id = $get_assesment_credit->id;
           $data_element_8->reference_assesment_credit_score_activity_id = $element8;
           $data_element_8->new_user_credit_score = $user_credit_score8;
           $save_elemet_8 = $data_element_8->save();
         }
         //Masukkan Nilai Unsur 9 Ke database assesment_credit_score
         $user_credit_score9=0;
         $element9=0;
         foreach ($get_elements_9 as $get_element_9) {
             foreach ($get_performance_target_scores as $get_performance_target_score) {
                 if($get_element_9->id == $get_performance_target_score->reference_activity_credit_score_id){
                     $element9=$element_9->id;
                     $user_credit_score9=$user_credit_score9+$get_performance_target_score->realization_credit_score;
                 }
             }
         }
         if($element9 != 0){
           $data_element_9 = new AssesmentCreditScore;
           $data_element_9->assesment_credit_id = $get_assesment_credit->id;
           $data_element_9->reference_assesment_credit_score_activity_id = $element9;
           $data_element_9->new_user_credit_score = $user_credit_score9;
           $save_elemet_9 = $data_element_9->save();
         }
         //Masukkan Nilai Unsur 10 Ke database assesment_credit_score
         $user_credit_score10=0;
         $element10=0;
         foreach ($get_elements_10 as $get_element_10) {
             foreach ($get_performance_target_scores as $get_performance_target_score) {
                 if($get_element_10->id == $get_performance_target_score->reference_activity_credit_score_id){
                     $element10=$element_10->id;
                     $user_credit_score10=$user_credit_score10+$get_performance_target_score->realization_credit_score;
                 }
             }
         }
         if($element10 != 0){
           $data_element_10 = new AssesmentCreditScore;
           $data_element_10->assesment_credit_id = $get_assesment_credit->id;
           $data_element_10->reference_assesment_credit_score_activity_id = $element10;
           $data_element_10->new_user_credit_score = $user_credit_score10;
           $save_elemet_10 = $data_element_10->save();
         }
         //Masukkan Nilai Unsur 11 Ke database assesment_credit_score
         $user_credit_score11=0;
         $element11=0;
         foreach ($get_elements_11 as $get_element_11) {
             foreach ($get_performance_target_scores as $get_performance_target_score) {
                 if($get_element_11->id == $get_performance_target_score->reference_activity_credit_score_id){
                     $element11=$element_11->id;
                     $user_credit_score11=$user_credit_score11+$get_performance_target_score->realization_credit_score;
                 }
             }
         }
         if($element11 != 0){
           $data_element_11 = new AssesmentCreditScore;
           $data_element_11->assesment_credit_id = $get_assesment_credit->id;
           $data_element_11->reference_assesment_credit_score_activity_id = $element11;
           $data_element_11->new_user_credit_score = $user_credit_score11;
           $save_elemet_11 = $data_element_11->save();
         }

         Alert::success('Berhasil', 'Pembuatan PAK Berhasil Dibuat');
         return redirect()->route('teachercs');
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
        $assesment=AssesmentCredit::where('id', $id)->first();
        $datas=AssesmentCreditScore::where('assesment_credit_id' , $id)->orderBy('reference_assesment_credit_score_activity_id', 'asc')->get();
        return view('teacher/creditscore/show', compact('assesment', 'datas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $idc)
    {
        $check=AssesmentCredit::where(['id'=> $idc, 'is_ready' => TRUE])->count();
        $data=AssesmentCreditScore::where('id' , $id)->first();
        if($check > 0){
          Alert::error('Gagal', 'Pengajuan PAK Sudah Dikunci!');
          return redirect()->back();
        }else{
          return view('teacher/creditscore/edit', compact('data', 'idc'));
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
        $data = AssesmentCreditScore::findOrFail($id);
        $total_user_credit_score=$data->new_user_credit_score+$request->old_credit_score;
        $data->update([
          'old_credit_score' => $request->old_credit_score,
          'total_user_credit_score' => $total_user_credit_score
        ]);

        if($data){
            Alert::success('Berhasil', 'Nilai Angka Kredit Lama Berhasil Ditambahkan');
            return redirect()->route('teachercsshow', $idc);
        } else {
            Alert::error('Gagal', 'Gagal Menambahkan Angka Kredit Lama! Silahkan ulangi beberapa saat lagi');
            return redirect()->back();
        }
    }

    public function createold($id)
    {
        $check=AssesmentCredit::where(['id'=> $id, 'is_ready' => TRUE])->count();
        $activities=ReferenceAssesmentCreditScoreActivity::all();
        if($check > 0){
          Alert::error('Gagal', 'Pengajuan PAK Sudah Dikunci!');
          return redirect()->back();
        }else{
            return view('teacher/creditscore/oldactivity', compact('activities', 'id'));
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

      $check=AssesmentCreditScore::where([
        'assesment_credit_id' => $id,
        'reference_assesment_credit_score_activity_id' => $request->reference_assesment_credit_score_activity_id
        ])->count();

      if($check > 0){
        Alert::error('Gagal', 'Kegiatan Sudah Ada!');
        return redirect()->back();
      }else{
        $data = new AssesmentCreditScore;
        $data->assesment_credit_id = $id;
        $data->reference_assesment_credit_score_activity_id = $request->reference_assesment_credit_score_activity_id;
        $data->old_credit_score = $request->last_assessment_credit_score;
        $data->new_user_credit_score = 0;
        $data->total_user_credit_score = $request->last_assessment_credit_score;
        $save = $data->save();

        Alert::success('Berhasil', 'Kegiatan PAK Lama Ditambahkan');
        return redirect()->route('teachercsshow', $id);
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
      $data = AssesmentCredit::findOrFail($id);
      $data->update([
        'is_ready' => TRUE
      ]);

      if($data){
          Alert::success('Berhasil', 'Pengajuan PAK Berhasil Dikunci');
          return redirect()->route('teachercs');
      } else {
          Alert::error('Gagal', 'Gagal Mengunci Pengajuan PAK! Silahkan ulangi beberapa saat lagi');
          return redirect()->back();
      }
    }
}
