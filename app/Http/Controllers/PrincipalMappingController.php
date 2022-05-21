<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PrincipalMapping;
use App\Models\PrincipalMappingSubject;
use App\Models\PrincipalMappingTeacher;
use App\Models\PrincipalMappingFinish;
use App\Models\PersonalData;
use App\Models\ReferenceSubject;
use App\Models\User;
use Validator;
use Alert;

class PrincipalMappingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $user_id = auth()->user()->id;
      $datas=PrincipalMapping::where(['user_id' => $user_id, 'is_deleted' => FALSE])->get();
      return view('principal/mapping/index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('principal/mapping/create');
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
              'school_type'                   => 'required',
              'study_year'                    => 'required',
              'school_statistic_number'       => 'required',
              'national_school_number'        => 'required',
              'school_date'                   => 'required',
              'school_accreditation'          => 'required',
              'principal_starting_from_date'  => 'required',
              'total_study_group'             => 'required',
              'total_student'                 => 'required'
          ];

          $messages = [
              'school_type.required'                    => 'Jenis Sekolah Wajib Dipilih',
              'study_year.required'                     => 'Tahun Pemetaan Wajib Diisi',
              'school_statistic_number.required'        => 'Nomor Statistik Sekolah (NSS) Wajib Diisi',
              'national_school_number.required'         => 'Nomor Pokok Sekolah Nasional (NPSN) Wajib Diisi',
              'school_date.required'                    => 'Tanggal Akreditasi Terakhir Wajib Diisi',
              'school_accreditation.required'           => 'Akreditasi Sekolah Wajib Dipilih',
              'principal_starting_from_date.required'   => 'T.M.T Kepala Sekolah Wajib Diisi',
              'total_study_group.required'              => 'Total Rombel Wajib Diisi',
              'total_student.required'                  => 'Total Peserta Didik Wajib Diisi'
          ];

          $validator = Validator::make($request->all(), $rules, $messages);

          if($validator->fails()){
              return redirect()->back()->withErrors($validator)->withInput($request->all);
          }

          $userr = auth()->user()->personal_data_id;
          $user=PersonalData::where('id', $userr)->first();
          $user_id = auth()->user()->id;

          $school_date = date("Y-m-d", strtotime($request->school_date));
          $principal_starting_from_date = date("Y-m-d", strtotime($request->principal_starting_from_date));

          $data = new PrincipalMapping;
          $data->school_type = $request->school_type;
          $data->study_year = $request->study_year;
          $data->school_statistic_number = $request->school_statistic_number;
          $data->national_school_number = $request->national_school_number;
          $data->school_date = $school_date;
          $data->school_accreditation = $request->school_accreditation;
          $data->work_unit_id = $user->work_unit_id;
          $data->user_id = $user_id;
          $data->principal_starting_from_date = $principal_starting_from_date;
          $data->total_study_group = $request->total_study_group;
          $data->total_student = $request->total_student;
          $data->is_locked = FALSE;
          $data->is_finish = FALSE;
          $data->is_deleted = FALSE;
          $save = $data->save();

          if($save){
              Alert::success('Berhasil', 'Pemetaan Berhasil Ditambahkan');
              return redirect()->route('principalmp');
          } else {
              Alert::error('Gagal', 'Gagal Membuat Pemetaan! Silahkan ulangi beberapa saat lagi');
              return redirect()->route('principalmpcreate');
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
        $data=PrincipalMapping::where('id', $id)->first();
        $subjects=PrincipalMappingSubject::where(['principal_mapping_id' => $id, 'is_deleted' => FALSE])->get();
        return view('principal/mapping/show', compact('data', 'subjects', 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function createsubject($id)
    {
        $data=PrincipalMapping::where('id', $id)->first();
        $subjects=ReferenceSubject::where(['lesson_level' => $data->school_type, 'is_deleted' => FALSE])->get();
        if($subjects == NULL){
          Alert::error('Gagal', 'Mata Pelajaran Untuk Jenjang Pendidikan Tidak DItemukan');
          return redirect()->back();
        }else{
          return view('principal/mapping/subject/create', compact('data', 'subjects', 'id'));
        }
    }

    public function storesubject(Request $request, $id)
    {
        $rules = [
              'reference_subject_id'  => 'required',
              'total_hour'            => 'required'
            ];

          $messages = [
              'reference_subject_id.required'  => 'Nama Mata Pelajaran Wajib Dipilih',
              'total_hour.required'            => 'Total Jam Pelajaran Keseluruhan Wajib Diisi'

          ];

          $validator = Validator::make($request->all(), $rules, $messages);

          if($validator->fails()){
              return redirect()->back()->withErrors($validator)->withInput($request->all);
          }

          $check=PrincipalMappingSubject::where(['principal_mapping_id' => $id, 'reference_subject_id' => $request->reference_subject_id, 'is_deleted' => FALSE])->count();

          if($check == 0){
            $data = new PrincipalMappingSubject;
            $data->principal_mapping_id = $id;
            $data->reference_subject_id = $request->reference_subject_id;
            $data->total_hour = $request->total_hour;
            $data->is_deleted = FALSE;
            $save = $data->save();

            if($save){
                Alert::success('Berhasil', 'Mata Pelajaran Berhasil Ditambahkan');
                return redirect()->route('principalmpshow', [$id]);
            } else {
                Alert::error('Gagal', 'Gagal Menambah Mata Pelajaran! Silahkan ulangi beberapa saat lagi');
                return redirect()->route('principalmpcreatesub', [$id]);
            }
          }else{
            Alert::error('Gagal', 'Mata Pelajaran Sudah Ditambahkan');
            return redirect()->route('principalmpcreatesub', [$id]);
          }

    }

    public function showsubject($id, $ids)
    {
        $data=PrincipalMappingSubject::where('id', $ids)->first();
        $teachers=PrincipalMappingTeacher::where(['principal_mapping_subject_id' => $ids, 'is_deleted' => FALSE])->get();
        $count=0;
        $hour=0;
        $teacher_hour=0;
        $teacher_count=0;
        $tn=0;
        $teacher_need=0;
        $dif=0;

        foreach($teachers as $teacher){
          $teacher_hour=$teacher_hour+$teacher->teaching_hour;
          $teacher_count=$teacher_count+1;
        }

        $tn=$data->total_hour/24;
        $teacher_need=floor($tn);
        $dif=$teacher_need-$teacher_count;

        if($dif < 0){
          $status = 2;
        }elseif($dif == 0){
          $status = 0;
        }elseif ($dif > 0) {
          $status = 1;
        }
        return view('principal/mapping/subject/show', compact('data', 'id', 'ids','status', 'teachers'));
    }

    public function createteacher($id, $ids)
    {
        $data=PrincipalMapping::where('id', $id)->first();
        $teachers=PersonalData::where('work_unit_id', $data->work_unit_id)->get();
        return view('principal/mapping/teacher/create', compact('teachers', 'id', 'ids'));
    }

    public function storeteacher(Request $request, $id, $ids)
    {
        $rules = [
              'user_id'           => 'required',
              'teaching_hour'     => 'required',
              'is_certification'  => 'required'
            ];

          $messages = [
              'user_id.required'            => 'Nama Tenaga Pendidik Wajib Dipilih',
              'teaching_hour.required'      => 'Jam Mengajar Wajib Diisi',
              'is_certification.required'   => 'Status Sertifikasi Wajib Dipilih'
            ];

          $validator = Validator::make($request->all(), $rules, $messages);

          if($validator->fails()){
              return redirect()->back()->withErrors($validator)->withInput($request->all);
          }

          $user=User::where(['personal_data_id' => $request->user_id, 'is_deleted' => FALSE])->first();

          $check=PrincipalMappingTeacher::where(['user_id' => $user->id, 'principal_mapping_subject_id' => $ids, 'is_deleted' => FALSE])->count();

          if($check == 0){
            $data = new PrincipalMappingTeacher;
            $data->user_id = $user->id;
            $data->principal_mapping_subject_id = $ids;
            $data->teaching_hour = $request->teaching_hour;
            $data->is_certification = $request->is_certification;
            $data->is_deleted = FALSE;
            $save = $data->save();

            if($save){
                Alert::success('Berhasil', 'Tenaga Pendidik Berhasil Ditambahkan');
                return redirect()->route('principalmpshowsub', [$id, $ids]);
            } else {
                Alert::error('Gagal', 'Gagal Menambah Tenaga Pendidik! Silahkan Ulangi Beberapa Saat Lagi');
                return redirect()->route('principalmpcreatetc', [$id, $ids]);
            }
          }else{
            Alert::error('Gagal', 'Tenaga Pendidik Sudah Ditambahkan');
            return redirect()->route('principalmpcreatetc', [$id, $ids]);
          }

    }

    public function finish(Request $request, $id)
    {
        $teacher_hour=0;
        $teacher_count=0;
        $tn=0;
        $teacher_need=0;
        $dif=0;
        $check=PrincipalMapping::where(['id' => $id, 'is_finish' => TRUE, 'is_deleted' => FALSE])->count();

        if($check == 0){
          $data = PrincipalMapping::findOrFail($id);
          $data->update([
            'is_locked' => TRUE,
            'is_finish' => TRUE
          ]);

          $subjects=PrincipalMappingSubject::where(['principal_mapping_id' => $id, 'is_deleted' => FALSE])->get();

          foreach($subjects as $subject){
            $teachers=PrincipalMappingTeacher::where(['principal_mapping_subject_id' => $subject->id, 'is_deleted' => FALSE])->get();
            foreach($teachers as $teacher){
              $teacher_hour=$teacher_hour+$teacher->teaching_hour;
              $teacher_count=$teacher_count+1;
            }

            $tn=$subject->total_hour/24;
            $teacher_need=floor($tn);
            $dif=$teacher_need-$teacher_count;

            $finish = new PrincipalMappingFinish;
            $finish->principal_mapping_id = $id;
            $finish->reference_subject_id = $subject->reference_subject_id;
            $finish->total_hour = $subject->total_hour;
            $finish->total_teacher_need = $teacher_need;
            $finish->total_teacher_hour = $teacher_hour;
            $finish->total_teacher = $teacher_count;
            $finish->total_difference = $dif;
            if($dif < 0){
              $finish->is_excess = TRUE;
              $finish->is_ideal = FALSE;
              $finish->is_lack = FALSE;
            }elseif ($dif == 0) {
              $finish->is_excess = FALSE;
              $finish->is_ideal = TRUE;
              $finish->is_lack = FALSE;
            }elseif ($dif > 0) {
              $finish->is_excess = FALSE;
              $finish->is_ideal = FALSE;
              $finish->is_lack = TRUE;
            }
            $save = $finish->save();

            $teacher_hour=0;
            $teacher_count=0;
          }

          $check=PrincipalMappingFinish::where('principal_mapping_id', $id)->count();
          if($check > 0){
              Alert::success('Berhasil', 'Pemetaan Berhasil Dikunci');
              return redirect()->route('principalmp');
          } else {
              Alert::error('Gagal', 'Gagal Mengunci Pemetaan! Silahkan Coba Beberapa Saat Lagi');
              return redirect()->back();
          }
        }else{
          Alert::error('Gagal', 'Gagal Mengunci Pemetaan! Silahkan Coba Beberapa Saat Lagi');
          return redirect()->back();
        }
    }

    public function pdf($id)
    {
        $detail=PrincipalMapping::where('id', $id)->first();
        $datas=PrincipalMappingFinish::where('principal_mapping_id', $id)->get();
        $userqrcode="Nama : {$detail->user->personalData->name}\nNIP : {$detail->user->personalData->registration_number}\nUnit Kerja : {$detail->user->personalData->workUnit->name}";
        return view('principal/mapping/pdf', compact('detail', 'datas', 'userqrcode'));
    }
}
