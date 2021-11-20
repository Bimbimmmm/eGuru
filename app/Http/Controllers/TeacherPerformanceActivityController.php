<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PerformanceTarget;
use App\Models\PerformanceTargetScore;
use App\Models\PerformanceTargetWorkBehavior;
use App\Models\ReferenceWorkBehavior;
use App\Models\ReferenceActivityCreditScore;
use App\Models\PositionMapping;
use Validator;
use Alert;

class TeacherPerformanceActivityController extends Controller
{
    public function createpbt($id){
      $check=PerformanceTarget::where('id', $id)->count();
      if($check > 0){
        Alert::error('Gagal', 'SKP Sudah Dikunci');
        return redirect()->back();
      }else{
        $datas=ReferenceActivityCreditScore::where('sub_element', 'PEMBELAJARAN/BIMBINGAN DAN TUGAS TERTENTU')->get();
        $count=PerformanceTargetScore::where('performance_target_id', $id)->count();
        return view('teacher/performance/activity/createpbt', compact('id', 'datas', 'count'));
      }
    }

    public function storepbt(Request $request, $id){
      $rules = [
          'reference_activity_credit_score_id'    => 'required',
          'target_quality'                        => 'required',
          'target_time'                           => 'required',
          'target_time_unit'                      => 'required',
          'target_cost'                           => 'required'
      ];

      $messages = [
          'reference_activity_credit_score_id.required'   => 'Jenis Kegiatan Wajib Diisi',
          'target_quality.required'                       => 'Target Kualitas Kegiatan Wajib Diisi',
          'target_time.required'                          => 'Target Waktu Kegiatan Wajib Diisi',
          'target_time_unit.required'                     => 'Unit Waktu Kegiatan Wajib Diisi',
          'target_cost.required'                          => 'Target Biaya Kegiatan Wajib Diisi'
      ];

      $validator = Validator::make($request->all(), $rules, $messages);

      if($validator->fails()){
          return redirect()->back()->withErrors($validator)->withInput($request->all);
      }
      $get1=ReferenceActivityCreditScore::where('activity_item', 'Melaksanakan proses pembelajaran')->first();
      $get2=ReferenceActivityCreditScore::where('activity_item', 'Melaksanakan proses bimbingan')->first();
      $get3=ReferenceActivityCreditScore::where('grain_item', 'Menjadi Wakil Kepala Sekolah per tahun')->first();
      $get4=ReferenceActivityCreditScore::where('grain_item', 'Menjadi Ketua program keahlian/program studi atau yang sejenisnya')->first();
      $get5=ReferenceActivityCreditScore::where('grain_item', 'Menjadi Kepala perpustakaan')->first();
      $get6=ReferenceActivityCreditScore::where('grain_item', 'Menjadi Kepala laboratorium, bengkel unit produksi atau yang sejenisnya')->first();
      $getoutput=ReferenceActivityCreditScore::where('id', $request->reference_activity_credit_score_id)->first();
      $getpkg1=PerformanceTargetScore::where(['performance_target_id' => $id, 'reference_activity_credit_score_id' => $get1->id])->first();
      $getpkg2=PerformanceTargetScore::where(['performance_target_id' => $id, 'reference_activity_credit_score_id' => $get2->id])->first();
      $getpkg3=PerformanceTargetScore::where(['performance_target_id' => $id, 'reference_activity_credit_score_id' => $get3->id])->first();
      $getpkg4=PerformanceTargetScore::where(['performance_target_id' => $id, 'reference_activity_credit_score_id' => $get4->id])->first();
      $getpkg5=PerformanceTargetScore::where(['performance_target_id' => $id, 'reference_activity_credit_score_id' => $get5->id])->first();
      $getpkg6=PerformanceTargetScore::where(['performance_target_id' => $id, 'reference_activity_credit_score_id' => $get6->id])->first();

      if($getpkg1 == null && $request->reference_activity_credit_score_id == $get1->id){//baru pertama menambahkan kegiatan guru biasa
        $data = new PerformanceTargetScore;
        $data->performance_target_id = $id;
        $data->reference_activity_credit_score_id = $request->reference_activity_credit_score_id;
        $data->target_credit_score = $request->target_credit_score;
        $data->target_qty = 1;
        $data->target_output = $getoutput->output;
        $data->target_quality = $request->target_quality;
        $data->target_time = $request->target_time;
        $data->target_time_unit = $request->target_time_unit;
        $data->target_cost = $request->target_cost;
        $data->is_deleted = FALSE;
        $save = $data->save();
      }else if($getpkg1 != null && $request->reference_activity_credit_score_id == $get3->id){//menambahkan kegiatan guru dengan tugas tambahan baru sebagai wakasek
        $data = new PerformanceTargetScore;
        $data->performance_target_id = $id;
        $data->reference_activity_credit_score_id = $request->reference_activity_credit_score_id;
        $data->target_credit_score = $request->target_credit_score;
        $data->target_qty = 1;
        $data->target_output = $getoutput->output;
        $data->target_quality = $request->target_quality;
        $data->target_time = $request->target_time;
        $data->target_time_unit = $request->target_time_unit;
        $data->target_cost = $request->target_cost;
        $data->is_deleted = FALSE;
        $save = $data->save();
      }else if($getpkg1 != null && $request->reference_activity_credit_score_id == $get4->id){//menambahkan kegiatan guru dengan tugas tambahan baru sebagai kaprgog
        $data = new PerformanceTargetScore;
        $data->performance_target_id = $id;
        $data->reference_activity_credit_score_id = $request->reference_activity_credit_score_id;
        $data->target_credit_score = $request->target_credit_score;
        $data->target_qty = 1;
        $data->target_output = $getoutput->output;
        $data->target_quality = $request->target_quality;
        $data->target_time = $request->target_time;
        $data->target_time_unit = $request->target_time_unit;
        $data->target_cost = $request->target_cost;
        $data->is_deleted = FALSE;
        $save = $data->save();
      }else if($getpkg1 != null && $request->reference_activity_credit_score_id == $get5->id){//menambahkan kegiatan guru dengan tugas tambahan baru sebagai kepala perpus
        $data = new PerformanceTargetScore;
        $data->performance_target_id = $id;
        $data->reference_activity_credit_score_id = $request->reference_activity_credit_score_id;
        $data->target_credit_score = $request->target_credit_score;
        $data->target_qty = 1;
        $data->target_output = $getoutput->output;
        $data->target_quality = $request->target_quality;
        $data->target_time = $request->target_time;
        $data->target_time_unit = $request->target_time_unit;
        $data->target_cost = $request->target_cost;
        $data->is_deleted = FALSE;
        $save = $data->save();
      }else if($getpkg1 != null && $request->reference_activity_credit_score_id == $get6->id){//menambahkan kegiatan guru dengan tugas tambahan baru sebagai kepala lab
        $data = new PerformanceTargetScore;
        $data->performance_target_id = $id;
        $data->reference_activity_credit_score_id = $request->reference_activity_credit_score_id;
        $data->target_credit_score = $request->target_credit_score;
        $data->target_qty = 1;
        $data->target_output = $getoutput->output;
        $data->target_quality = $request->target_quality;
        $data->target_time = $request->target_time;
        $data->target_time_unit = $request->target_time_unit;
        $data->target_cost = $request->target_cost;
        $data->is_deleted = FALSE;
        $save = $data->save();
      }else if($getpkg2 == null && $request->reference_activity_credit_score_id == $get2->id){//menambahkan kegiatan guru dengan tugas tambahan baru sebagai wakasek
        $data = new PerformanceTargetScore;
        $data->performance_target_id = $id;
        $data->reference_activity_credit_score_id = $request->reference_activity_credit_score_id;
        $data->target_credit_score = $request->target_credit_score;
        $data->target_qty = 1;
        $data->target_output = $getoutput->output;
        $data->target_quality = $request->target_quality;
        $data->target_time = $request->target_time;
        $data->target_time_unit = $request->target_time_unit;
        $data->target_cost = $request->target_cost;
        $data->is_deleted = FALSE;
        $save = $data->save();
      }else if($getpkg2 != null && $request->reference_activity_credit_score_id == $get3->id){//menambahkan kegiatan guru bk dengan tugas tambahan baru sebagai wakasek
        $data = new PerformanceTargetScore;
        $data->performance_target_id = $id;
        $data->reference_activity_credit_score_id = $request->reference_activity_credit_score_id;
        $data->target_credit_score = $request->target_credit_score;
        $data->target_qty = 1;
        $data->target_output = $getoutput->output;
        $data->target_quality = $request->target_quality;
        $data->target_time = $request->target_time;
        $data->target_time_unit = $request->target_time_unit;
        $data->target_cost = $request->target_cost;
        $data->is_deleted = FALSE;
        $save = $data->save();
      }else if($request->target_credit_score == null){//menambahkan kegiatan baru
        if($getpkg1 != null && $getpkg3 != null){
          $pkgtargetcreditscore=(float)$getpkg1->target_credit_score+(float)$getpkg3->target_credit_score;
        }else if($getpkg1 != null && $getpkg4 != null){
          $pkgtargetcreditscore=(float)$getpkg1->target_credit_score+(float)$getpkg4->target_credit_score;
        }else if($getpkg1 != null && $getpkg5 != null){
          $pkgtargetcreditscore=(float)$getpkg1->target_credit_score+(float)$getpkg5->target_credit_score;
        }else if($getpkg1 != null && $getpkg6 != null){
          $pkgtargetcreditscore=(float)$getpkg1->target_credit_score+(float)$getpkg6->target_credit_score;
        }else if($getpkg1 != null && $getpkg3 == null){
          $pkgtargetcreditscore=(float)$getpkg1->target_credit_score;
        }else if($getpkg1 != null && $getpkg4 == null){
          $pkgtargetcreditscore=(float)$getpkg1->target_credit_score;
        }else if($getpkg1 != null && $getpkg5 == null){
          $pkgtargetcreditscore=(float)$getpkg1->target_credit_score;
        }else if($getpkg1 != null && $getpkg6 == null){
          $pkgtargetcreditscore=(float)$getpkg1->target_credit_score;
        }else if($getpkg2 != null && $getpkg3 != null){
          $pkgtargetcreditscore=(float)$getpkg2->target_credit_score+(float)$getpkg3->target_credit_score;
        }else if($getpkg2 != null && $getpkg4 != null){
          $pkgtargetcreditscore=(float)$getpkg2->target_credit_score+(float)$getpkg4->target_credit_score;
        }else if($getpkg2 != null && $getpkg5 != null){
          $pkgtargetcreditscore=(float)$getpkg2->target_credit_score+(float)$getpkg5->target_credit_score;
        }else if($getpkg2 != null && $getpkg6 != null){
          $pkgtargetcreditscore=(float)$getpkg2->target_credit_score+(float)$getpkg6->target_credit_score;
        }else if($getpkg2 != null && $getpkg3 == null){
          $pkgtargetcreditscore=(float)$getpkg2->target_credit_score;
        }else if($getpkg2 != null && $getpkg4 == null){
          $pkgtargetcreditscore=(float)$getpkg2->target_credit_score;
        }else if($getpkg2 != null && $getpkg5 == null){
          $pkgtargetcreditscore=(float)$getpkg2->target_credit_score;
        }else if($getpkg2 != null && $getpkg6 == null){
          $pkgtargetcreditscore=(float)$getpkg2->target_credit_score;
        }

        if($request->target_time <12){
        $target_credit_score=0.02*$pkgtargetcreditscore;
        }else{
          $target_credit_score=0.05*$pkgtargetcreditscore;
        }

        $data = new PerformanceTargetScore;
        $data->performance_target_id = $id;
        $data->reference_activity_credit_score_id = $request->reference_activity_credit_score_id;
        $data->target_credit_score = $target_credit_score;
        $data->target_qty = 1;
        $data->target_output = $getoutput->output;
        $data->target_quality = $request->target_quality;
        $data->target_time = $request->target_time;
        $data->target_time_unit = $request->target_time_unit;
        $data->target_cost = $request->target_cost;
        $data->is_deleted = FALSE;
        $save = $data->save();
      }

      if($save){
        Alert::success('Berhasil', 'Kegiatan Tugas Jabatan Berhasil Ditambahkan');
        return redirect()->route('teacherptshow', $id);
      } else {
          Alert::error('Gagal', 'Gagal Menambahkan Kegiatan Tugas Jabatan! Silahkan ulangi beberapa saat lagi');
          return redirect()->route('teacherptapbt', $id);
      }
    }

    public function createpkb($id){
      $check=PerformanceTarget::where('id', $id)->count();
      if($check > 0){
        Alert::error('Gagal', 'SKP Sudah Dikunci');
        return redirect()->back();
      }else{
        $uuid=ReferenceActivityCreditScore::where('activity_item', 'Mengikuti pelatihan prajabatan')->first();
        $datas=ReferenceActivityCreditScore::where('sub_element', 'PENGEMBANGAN KEPROFESIAN BERKELANJUTAN')->get();
        return view('teacher/performance/activity/createpkb', compact('id', 'datas'));
      }
    }

    public function store(Request $request, $id){
      $rules = [
          'reference_activity_credit_score_id'    => 'required',
          'target_qty'                            => 'required',
          'target_quality'                        => 'required',
          'target_time'                           => 'required',
          'target_time_unit'                      => 'required',
          'target_cost'                           => 'required'
      ];

      $messages = [
          'reference_activity_credit_score_id.required'   => 'Jenis Kegiatan Wajib Diisi',
          'target_qty.required'                           => 'Target Banyaknya Kegiatan Wajib Diisi',
          'target_quality.required'                       => 'Target Kualitas Kegiatan Wajib Diisi',
          'target_time.required'                          => 'Target Waktu Kegiatan Wajib Diisi',
          'target_time_unit.required'                     => 'Unit Waktu Kegiatan Wajib Diisi',
          'target_cost.required'                          => 'Target Biaya Kegiatan Wajib Diisi'
      ];

      $validator = Validator::make($request->all(), $rules, $messages);

      if($validator->fails()){
          return redirect()->back()->withErrors($validator)->withInput($request->all);
      }

      $getdata=ReferenceActivityCreditScore::where('id', $request->reference_activity_credit_score_id)->first();
      (float)$target_credit_score=$request->target_qty*$getdata->credit_score;

      $data = new PerformanceTargetScore;
      $data->performance_target_id = $id;
      $data->reference_activity_credit_score_id = $request->reference_activity_credit_score_id;
      $data->target_credit_score = $target_credit_score;
      $data->target_qty = $request->target_qty;
      $data->target_output = $getdata->output;
      $data->target_quality = $request->target_quality;
      $data->target_time = $request->target_time;
      $data->target_time_unit = $request->target_time_unit;
      $data->target_cost = $request->target_cost;
      $data->is_deleted = FALSE;
      $save = $data->save();

      if($save){
        Alert::success('Berhasil', 'Kegiatan Tugas Jabatan Berhasil Ditambahkan');
        return redirect()->route('teacherptshow', $id);
      } else {
          Alert::error('Gagal', 'Gagal Menambahkan Kegiatan Tugas Jabatan! Silahkan ulangi beberapa saat lagi');
          return redirect()->route('teacherptapkb', $id);
      }
    }

    public function createup($id){
      $check=PerformanceTarget::where('id', $id)->count();
      if($check > 0){
        Alert::error('Gagal', 'SKP Sudah Dikunci');
        return redirect()->back();
      }else{
        $datas=ReferenceActivityCreditScore::where('sub_element', 'PENUNJANG TUGAS GURU')->get();
        return view('teacher/performance/activity/createup', compact('id', 'datas'));
      }
    }

    public function show($id, $idpt){
      $data=PerformanceTargetScore::where(['id' => $id, 'is_deleted' => FALSE])->first();
      return view('teacher/performance/activity/show', compact('id', 'idpt', 'data'));
    }

    public function uploadproof(Request $request, $id, $idpt){
      $rules = [
          'file'    => 'required',
          'file.*'  => 'mimes:pdf|max:2048'
      ];

      $messages = [
          'file.required'   => 'File Bukti Wajib Diisi',
          'file.mimes'      => 'File Bukti wajib berekstensi .pdf'
      ];

      $validator = Validator::make($request->all(), $rules, $messages);

      if($validator->fails()){
          return redirect()->back()->withErrors($validator)->withInput($request->all);
      }

      $original_name = $request->file->getClientOriginalName();
      $file = 'file_bukti_kegiatan_skp_' . time() . '_' . $original_name;
      $request->file->move(public_path('storage/performancetarget/activity'), $file);

      $data = PerformanceTargetScore::findOrFail($id);
      $data->update([
          'file'            => $file
      ]);

      if($data){
            Alert::success('Berhasil', 'File Bukti Sudah Diupload');
            return redirect()->route('teacherptshow', $idpt);
      } else {
            Alert::error('Gagal', 'Gagal Mengupload File Bukti! Silahkan ulangi beberapa saat lagi');
            return redirect()->back();
      }
    }

    public function delete($id){
      $data = PerformanceTargetScore::findOrFail($id);
      $data->update([
          'is_deleted'            => TRUE
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
