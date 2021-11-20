<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PerformanceTarget;
use App\Models\PerformanceTargetScore;
use App\Models\PerformanceTargetWorkBehavior;
use App\Models\ReferenceWorkBehavior;
use App\Models\ReferenceActivityCreditScore;
use App\Models\PositionMapping;
use App\Models\User;
use Validator;
use Alert;

class TeacherPerformanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $datas=PerformanceTarget::where(['user_id' => $user_id, 'is_deleted' => FALSE])->get();
        return view('teacher/performance/index', compact('datas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $check=PerformanceTarget::where(['assessment_year' => $request->assessment_year, 'is_deleted' => FALSE])->count();
      if($check > 0){
        Alert::error('Gagal', 'Tahun SKP Sudah Ada');
        return redirect()->back();
      }else{
        $rules = [
            'assessment_year'       => 'required',
            'period'                => 'required',
            'file_lesson_plan'      => 'required',
            'file_lesson_plan.*'    => 'mimes:pdf|max:2048',
            'file_instrument'       => 'required',
            'file_instrument.*'     => 'mimes:pdf|max:2048',
            'file_mapping'          => 'required',
            'file_mapping.*'        => 'mimes:pdf|max:2048'

        ];

        $messages = [
            'assessment_year.required'             => 'Tahun SKP Wajib Diisi',
            'period.required'                      => 'Periode SKP Wajib Diisi',
            'file_lesson_plan.required'            => 'File RPP Wajib Diisi',
            'file_lesson_plan.mimes'               => 'File RPP Maksimal 2MB dan Memiliki Ekstensi .pdf',
            'file_instrument.required'             => 'File Instrumen Wajib Diisi',
            'file_instrument.mimes'                => 'File Instrumen Maksimal 2MB dan Memiliki Ekstensi .pdf',
            'file_mapping.required'                => 'File Pemetaan Wajib Diisi',
            'file_mapping.mimes'                   => 'File Pemetaan Maksimal 2MB dan Memiliki Ekstensi .pdf',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $user_id = auth()->user()->id;
        $work_unit_id = auth()->user()->personalData->work_unit_id;
        $rank_id = auth()->user()->personalData->rank_id;
        $position_mapping = PositionMapping::where(['work_unit_id' => $work_unit_id, 'is_active' => TRUE])->first();

        $original_name = $request->file_lesson_plan->getClientOriginalName();
        $file_lesson_plan = 'file_rpp_' . time() . '_' . $original_name;
        $request->file_lesson_plan->move(public_path('storage/performancetarget'), $file_lesson_plan);

        $original_name = $request->file_instrument->getClientOriginalName();
        $file_instrument = 'file_instrumen_' . time() . '_' . $original_name;
        $request->file_instrument->move(public_path('storage/performancetarget'), $file_instrument);

        $original_name = $request->file_mapping->getClientOriginalName();
        $file_mapping = 'file_pemetaan_' . time() . '_' . $original_name;
        $request->file_mapping->move(public_path('storage/performancetarget'), $file_mapping);


        $data = new PerformanceTarget;
        $data->user_id = $user_id;
        $data->work_unit_id = $work_unit_id;
        $data->assessment_year = $request->assessment_year;
        $data->rank_id = $rank_id;
        $data->period = $request->period;
        $data->position_mapping_id = $position_mapping->id;
        $data->is_ready = FALSE;
        $data->is_direct_supervisor_approve = FALSE;
        $data->is_official_approve = FALSE;
        $data->is_correction = FALSE;
        $data->file_lesson_plan = $file_lesson_plan;
        $data->file_instrument = $file_instrument;
        $data->file_mapping = $file_mapping;
        $data->is_deleted = FALSE;
        $save = $data->save();

        if($save){
            Alert::success('Berhasil', 'SKP Berhasil Dibuat');
            return redirect()->route('teacherpt');
        } else {
            Alert::error('Gagal', 'Gagal Membuat SKP! Silahkan ulangi beberapa saat lagi');
            return redirect()->route('teacherptcreate');
        }
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
        $data=PerformanceTarget::where('id', $id)->first();
        $count=PerformanceTargetScore::where('performance_target_id', $id)->count();
        $activities=PerformanceTargetScore::where(['performance_target_id' => $id, 'is_deleted' => FALSE])->orderBy('created_at', 'ASC')->get();
        return view('teacher/performance/show', compact('data', 'count', 'activities'));
    }

    public function lock($id){
      $data = PerformanceTarget::findOrFail($id);
      $data->update([
          'is_ready'            => TRUE
      ]);

      if($data){
            Alert::success('Berhasil', 'SKP Berhasil Dikunci');
            return redirect()->back();
      } else {
            Alert::error('Gagal', 'Gagal Mengunci SKP! Silahkan ulangi beberapa saat lagi');
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
      $data = PerformanceTarget::findOrFail($id);
      $data->update([
          'is_deleted'            => TRUE
      ]);

      if($data){
            Alert::success('Berhasil', 'SKP Sudah Dihapus');
            return redirect()->back();
      } else {
            Alert::error('Gagal', 'Gagal Menghapus SKP! Silahkan ulangi beberapa saat lagi');
            return redirect()->back();
      }
    }

    public function showdp3($id){
      $user_id = auth()->user()->id;
      $getdatas=PerformanceTarget::where('id', $id)->first();
      $getboss=PositionMapping::where('id', $getdatas->position_mapping_id)->first();

      $get1=ReferenceWorkBehavior::where('name', 'Orientasi Pelayanan')->first();
      $get2=ReferenceWorkBehavior::where('name', 'Integritas')->first();
      $get3=ReferenceWorkBehavior::where('name', 'Komitmen')->first();
      $get4=ReferenceWorkBehavior::where('name', 'Disiplin')->first();
      $get5=ReferenceWorkBehavior::where('name', 'Kerjasama')->first();

      $scoreget1=PerformanceTargetWorkBehavior::where(['performance_target_id' => $id, 'reference_work_behavior_id'=> $get1->id])->first();
      $scoreget2=PerformanceTargetWorkBehavior::where(['performance_target_id' => $id, 'reference_work_behavior_id'=> $get2->id])->first();
      $scoreget3=PerformanceTargetWorkBehavior::where(['performance_target_id' => $id, 'reference_work_behavior_id'=> $get3->id])->first();
      $scoreget4=PerformanceTargetWorkBehavior::where(['performance_target_id' => $id, 'reference_work_behavior_id'=> $get4->id])->first();
      $scoreget5=PerformanceTargetWorkBehavior::where(['performance_target_id' => $id, 'reference_work_behavior_id'=> $get5->id])->first();

      $final= $scoreget1->score + $scoreget2->score + $scoreget3->score + $scoreget4->score + $scoreget5->score;
      $average=$final/5;
      $wb40=$average*40/100;
      $count=PerformanceTargetScore::where(['performance_target_id' => $id, 'is_deleted' => FALSE])->count();
      $getperformancetargetscores=PerformanceTargetScore::where(['performance_target_id' => $id, 'is_deleted' => FALSE])->get();
      $getwbscores=PerformanceTargetWorkBehavior::where(['performance_target_id' => $id, 'is_deleted' => FALSE])->get();
      $countwb=PerformanceTargetWorkBehavior::where(['performance_target_id' => $id, 'is_deleted' => FALSE])->count();
      (float)$score=0;
      foreach ($getperformancetargetscores as $getperformancetargetscore) {
          $score=$score+$getperformancetargetscore->performance_value;
      }
      (float)$scorewb=0;
      foreach ($getwbscores as $getwbscore) {
          $scorewb=$scorewb+$getwbscore->score;
      }
      (float)$finalscore=($score/$count)*60/100;
      (float)$finalskpscore=($score/$count);
      (float)$secondscore=($scorewb/$countwb)*40/100;
      (float)$finalwbscore=($scorewb/$countwb);

      $selfdatas=User::where('id', $user_id)->first();
      $directsup=User::where('id', $getboss->principal_id)->first();
      $official=User::where('id', $getboss->supervisor_id)->first();

      $userqrcode="Nama : {$selfdatas->personalData->name}\nNIP : {$selfdatas->personalData->registration_number}\nUnit Kerja : {$selfdatas->personalData->workUnit->name}";
      $directspvqrcode="Nama : {$directsup->personalData->name}\nNIP : {$directsup->personalData->registration_number}\nJabatan : {$directsup->personalData->position->name}\nUnit Kerja : {$directsup->personalData->workUnit->name}";
      $officialqrcode="Nama : {$official->personalData->name}\nNIP : {$official->personalData->registration_number}\nJabatan : {$official->personalData->position->name}\nUnit Kerja : {$official->personalData->workUnit->name}";

      return view ('teacher/performance/result/dp3', compact(
        'getdatas',
        'userqrcode',
        'directspvqrcode',
        'officialqrcode',
        'directsup',
        'official',
        'selfdatas',
        'finalskpscore',
        'finalscore',
        'finalwbscore',
        'finalwbscore',
        'scoreget1',
        'scoreget2',
        'scoreget3',
        'scoreget4',
        'scoreget5',
        'final',
        'average',
        'wb40'
      ));
    }
}
