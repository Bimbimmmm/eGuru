<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewPerformanceTarget;
use App\Models\NewPerformanceTargetScore;
use App\Models\NewPerformanceTargetWorkBehavior;
use App\Models\ReferenceNewWorkBehaviour;
use App\Models\ReferencePerformanceTargetElement;
use App\Models\PositionMapping;
use App\Models\User;
use Validator;
use Alert;

class TeacherNewPerformanceTargetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $user_id = auth()->user()->id;
      $datas=NewPerformanceTarget::where(['user_id' => $user_id, 'is_deleted' => FALSE])->get();
      return view('teacher/performance/new/index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('teacher/performance/new/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $check=NewPerformanceTarget::where(['assessment_year' => $request->assessment_year, 'is_deleted' => FALSE])->count();
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


        $data = new NewPerformanceTarget;
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
            return redirect()->route('teachernpt');
        } else {
            Alert::error('Gagal', 'Gagal Membuat SKP! Silahkan ulangi beberapa saat lagi');
            return redirect()->route('teachernptcreate');
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
      $data=NewPerformanceTarget::where('id', $id)->first();
      $count=NewPerformanceTargetScore::where(['new_performance_target_id' => $id, 'is_deleted' => FALSE])->count();
      $activities=NewPerformanceTargetScore::where(['new_performance_target_id' => $id, 'is_deleted' => FALSE])->orderBy('created_at', 'ASC')->get();
      return view('teacher/performance/new/show', compact('data', 'count', 'activities'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
