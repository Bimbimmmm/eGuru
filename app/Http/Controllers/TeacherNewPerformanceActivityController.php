<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewPerformanceTarget;
use App\Models\NewPerformanceTargetScore;
use App\Models\NewPerformanceTargetWorkBehavior;
use App\Models\ReferenceNewWorkBehaviour;
use App\Models\ReferencePerformanceTargetElement;
use App\Models\PositionMapping;
use Validator;
use Alert;

class TeacherNewPerformanceActivityController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createmain($id)
    {
        $check=NewPerformanceTarget::where(['id' => $id, 'is_ready' => TRUE])->count();
        if($check > 0){
          Alert::error('Gagal', 'SKP Sudah Dikunci');
          return redirect()->back();
        }else{
          $datas=ReferencePerformanceTargetElement::where('element', 'KINERJA UTAMA')->get();
          $count=NewPerformanceTargetScore::where('new_performance_target_id', $id)->count();
          return view('teacher/performance/new/activity/createmain', compact('id', 'datas', 'count'));
        }
    }

    public function createadditional($id)
    {
        $check=NewPerformanceTarget::where(['id' => $id, 'is_ready' => TRUE])->count();
        if($check > 0){
          Alert::error('Gagal', 'SKP Sudah Dikunci');
          return redirect()->back();
        }else{
          $datas=ReferencePerformanceTargetElement::where('element', 'KINERJA TAMBAHAN')->get();
          $count=NewPerformanceTargetScore::where('new_performance_target_id', $id)->count();
          return view('teacher/performance/new/activity/createadditional', compact('id', 'datas', 'count'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storemain(Request $request, $id)
    {
        $rules = [
            'reference_performance_target_element_id'    => 'required',
            'target_quality'                             => 'required',
            'target_time'                                => 'required'
        ];

        $messages = [
            'reference_performance_target_element_id.required'  => 'Butir Kegiatan Wajib Dipilih',
            'target_quality.required'                           => 'Target Mutu Kegiatan Wajib Diisi',
            'target_time.required'                              => 'Target Waktu Kegiatan Wajib Diisi'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }
        $get=ReferencePerformanceTargetElement::where('id', $request->reference_performance_target_element_id)->first();
        if($get->code < 20){
          $data = new NewPerformanceTargetScore;
          $data->new_performance_target_id = $id;
          $data->reference_performance_target_element_id = $request->reference_performance_target_element_id;
          $data->target_credit_score = $request->target_credit_score;
          $data->target_qty = 1;
          $data->target_quality = $request->target_quality;
          $data->target_time = $request->target_time;
          $data->is_rejected_by_assesor = FALSE;
          $data->is_deleted = FALSE;
          $save = $data->save();
        }elseif($get->code > 19 && $get->credit_score == NULL) {
          $querys=NewPerformanceTargetScore::where(['new_performance_target_id' => $id, 'is_deleted' => FALSE])->get();
          $query_count=NewPerformanceTargetScore::where(['new_performance_target_id' => $id, 'is_deleted' => FALSE])->count();
          $creditscore=0;
          $target_credit_score=0;
          if($query_count > 0){
            foreach ($querys as $query) {
              if($query->refPerformanceElement->code < 20){
                $creditscore=$creditscore+$query->target_credit_score;
              }
            }
              if($request->target_time < 12){
                $target_credit_score=0.02*$creditscore;
              }else{
                $target_credit_score=0.05*$creditscore;
              }
              $data = new NewPerformanceTargetScore;
              $data->new_performance_target_id = $id;
              $data->reference_performance_target_element_id = $request->reference_performance_target_element_id;
              $data->target_credit_score = $target_credit_score;
              $data->target_qty = 1;
              $data->target_quality = $request->target_quality;
              $data->target_time = $request->target_time;
              $data->is_rejected_by_assesor = FALSE;
              $data->is_deleted = FALSE;
              $save = $data->save();
          }else{
            Alert::error('Gagal', 'Belum Memasukkan Kegiatan Pembelajaran/Bimbingan/Tugas Tertentu');
            return redirect()->back();
          }
        }else{
          (float)$target_credit_score=$get->credit_score*$request->target_quantity;

          $data = new NewPerformanceTargetScore;
          $data->new_performance_target_id = $id;
          $data->reference_performance_target_element_id = $request->reference_performance_target_element_id;
          $data->target_credit_score = $target_credit_score;
          $data->target_qty = $request->target_quantity;
          $data->target_quality = $request->target_quality;
          $data->target_time = $request->target_time;
          $data->is_rejected_by_assesor = FALSE;
          $data->is_deleted = FALSE;
          $save = $data->save();
        }
        if($save){
          Alert::success('Berhasil', 'Kinerja Utama Berhasil Ditambahkan');
          return redirect()->route('teachernptshow', $id);
        } else {
            Alert::error('Gagal', 'Gagal Menambahkan Kinerja Utama! Silahkan ulangi beberapa saat lagi');
            return redirect()->route('teachernptshow', $id);
        }
    }

    public function storeaddittional(Request $request, $id)
    {
        $rules = [
            'reference_performance_target_element_id'   => 'required',
            'target_qty'                                => 'required',
            'target_quality'                            => 'required',
            'target_time'                               => 'required'
        ];

        $messages = [
            'reference_performance_target_element_id.required'    => 'Butir Kegiatan Wajib Dipilih',
            'target_qty.required'                                 => 'Target Banyaknya Kegiatan Wajib Diisi',
            'target_quality.required'                             => 'Target Kualitas Kegiatan Wajib Diisi',
            'target_time.required'                                => 'Target Waktu Kegiatan Wajib Diisi'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $getdata=ReferencePerformanceTargetElement::where('id', $request->reference_performance_target_element_id)->first();
        (float)$target_credit_score=$request->target_qty*$getdata->credit_score;

        $data = new NewPerformanceTargetScore;
        $data->new_performance_target_id = $id;
        $data->reference_performance_target_element_id = $request->reference_performance_target_element_id;
        $data->target_credit_score = $target_credit_score;
        $data->target_qty = $request->target_qty;
        $data->target_quality = $request->target_quality;
        $data->target_time = $request->target_time;
        $data->is_rejected_by_assesor = FALSE;
        $data->is_deleted = FALSE;
        $save = $data->save();

        if($save){
          Alert::success('Berhasil', 'Kegiatan Tugas Jabatan Berhasil Ditambahkan');
          return redirect()->route('teachernptshow', $id);
        } else {
            Alert::error('Gagal', 'Gagal Menambahkan Kegiatan Tugas Jabatan! Silahkan ulangi beberapa saat lagi');
            return redirect()->route('teachernptshow', $id);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function show($id, $idpt){
       $data=NewPerformanceTargetScore::where(['id' => $id, 'is_deleted' => FALSE])->first();
       return view('teacher/performance/new/activity/show', compact('id', 'idpt', 'data'));
     }

     public function uploadproof(Request $request, $id, $idpt){
       $rules = [
           'file'    => 'required',
           'file.*'  => 'mimes:pdf|max:2048'
       ];

       $messages = [
           'file.required'   => 'File Bukti Wajib Diisi',
           'file.mimes'      => 'File Bukti Wajib Berekstensi .pdf'
       ];

       $validator = Validator::make($request->all(), $rules, $messages);

       if($validator->fails()){
           return redirect()->back()->withErrors($validator)->withInput($request->all);
       }

       $original_name = $request->file->getClientOriginalName();
       $file = 'file_bukti_kegiatan_skp_' . time() . '_' . $original_name;
       $request->file->move(public_path('storage/performancetarget/activity'), $file);

       $data = NewPerformanceTargetScore::findOrFail($id);
       $data->update([
           'file'            => $file
       ]);

       if($data){
             Alert::success('Berhasil', 'File Bukti Sudah Diupload');
             return redirect()->route('teachernptshow', $idpt);
       } else {
             Alert::error('Gagal', 'Gagal Mengupload File Bukti! Silahkan Ulangi Beberapa Saat Lagi');
             return redirect()->back();
       }
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
        $data = NewPerformanceTargetScore::findOrFail($id);
        $data->update([
            'is_deleted'  => TRUE
        ]);

        if($data){
              Alert::success('Berhasil', 'Kegiatan Sudah Dihapus');
              return redirect()->back();
        } else {
              Alert::error('Gagal', 'Gagal Menghapus Kegiatan! Silahkan ulangi beberapa saat lagi');
              return redirect()->back();
        }
    }
}
