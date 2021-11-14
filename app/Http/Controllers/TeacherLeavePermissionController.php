<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReferenceLeaveType;
use App\Models\LeavePermissions;
use App\Models\PersonalData;
use App\Models\SchoolOfficial;
use HariLibur;
use Validator;
use Alert;
use Carbon\Carbon;

class TeacherLeavePermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $datas=LeavePermissions::where('user_id', $user_id)->latest()->get();
        return view('teacher/leavepermission/index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $leavetypes=ReferenceLeaveType::all();
        return view('teacher/leavepermission/create', compact('leavetypes'));
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
            'leave_type_id'               => 'required',
            'leave_excuse'                => 'required',
            'start_date'                  => 'required',
            'end_date'                    => 'required',
            'leave_address'               => 'required',
            'file_recommendation_letter'  => 'required',
            'file_leave_application'      => 'required'
        ];

        $messages = [
            'leave_type_id.required'                  => 'Jenis Cuti Wajib Diisi',
            'leave_excuse.required'                   => 'Alasan Cuti wajib diisi',
            'start_date.required'                     => 'Tanggal Mulai Cuti Wajib Diisi',
            'end_date.required'                       => 'Tanggal Selesai Cuti Wajib Diisi',
            'leave_address.required'                  => 'Alamat Selama Cuti Wajib Diisi',
            'file_recommendation_letter.required'     => 'File Rekomendasi Wajib Diupload',
            'file_leave_application.required'         => 'File Permohonan Cuti Wajib Diupload'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }
        $start_date=Carbon::parse($request->start_date);
        $end_date=Carbon::parse($request->end_date);
        $duration = $start_date->diffInDays($end_date);
        $temp_duration=$duration+1;
        $date_start = date('d-m-Y',strtotime($start_date));
        $date_end = date('d-m-Y',strtotime($end_date));
        $dateall;
        $day_on=0;
        $weekend_days=0;
        $weekend=0;

        for($x=0;$x<$temp_duration;$x++){
          $dateall[$x]=$date_start;
          $tomorrow = strtotime($date_start."+1 day");
          $time = date("d-m-Y" ,$tomorrow);
          $date_start = date('d-m-Y',strtotime($time));
        }
        for($i=0;$i<$temp_duration;$i++){
          if(HariLibur::date($dateall[$i])->isDayOff()){
            $check=HariLibur::date($dateall[$i])->isWeekend();
            if($check == true){
              $weekend_days=$weekend_days+1;
            }
          }else{
            $day_on=$day_on+1;
          }
        }

        if($weekend_days > 1 ){
          $weekend=$weekend_days/2;
        }else{
          $weekend=$weekend_days;
        }
        $leave_duration=$day_on+$weekend;

        $start_date = date("Y-m-d", strtotime($request->start_date));
        $end_date = date("Y-m-d", strtotime($request->end_date));

        if($request->file_recommendation_letter != null){
          $original_name = $request->file_recommendation_letter->getClientOriginalName();
          $file_recommendation_letter = 'file_surat_rekomendasi_' . time() . '_' . $original_name;
          $request->file_recommendation_letter->move(public_path('storage/leavepermission'), $file_recommendation_letter);
        }else{
          $file_recommendation_letter = null;
        }

        if($request->file_leave_application != null){
          $original_name = $request->file_leave_application->getClientOriginalName();
          $file_leave_application = 'file_surat_permohonan_' . time() . '_' . $original_name;
          $request->file_leave_application->move(public_path('storage/leavepermission'), $file_leave_application);
        }else{
          $file_leave_application = null;
        }

        if($request->file_temporary_permission != null){
          $original_name = $request->file_temporary_permission->getClientOriginalName();
          $file_temporary_permission = 'file_surat_ijin_sementara_' . time() . '_' . $original_name;
          $request->file_temporary_permission->move(public_path('storage/leavepermission'), $file_temporary_permission);
        }else{
          $file_temporary_permission = null;
        }

        if($request->file_proof != null){
          $original_name = $request->file_proof->getClientOriginalName();
          $file_proof = 'file_bukti_lainnya_' . time() . '_' . $original_name;
          $request->file_proof->move(public_path('storage/leavepermission'), $file_proof);
        }else{
          $file_proof = null;
        }

        $user_id = auth()->user()->id;
        $reg_number = auth()->user()->registration_number;
        $personaldata=PersonalData::where('registration_number', $reg_number)->first();

        $principal_official=SchoolOfficial::where('work_unit_id', $personaldata->work_unit_id)->first();

        $leave = new LeavePermissions;
        $leave->user_id = $user_id;
        $leave->leave_type_id = $request->leave_type_id;
        $leave->leave_year = $request->leave_year;
        $leave->leave_excuse = $request->leave_excuse;
        $leave->leave_duration = $leave_duration;
        $leave->start_date = $start_date;
        $leave->end_date = $end_date;
        $leave->leave_address = $request->leave_address;
        $leave->is_direct_supervisor_approve = FALSE;
        $leave->school_official_id = $principal_official->id;
        $leave->is_official_approve = FALSE;
        $leave->file_recommendation_letter = $file_recommendation_letter;
        $leave->file_temporary_permission = $file_temporary_permission;
        $leave->file_leave_application = $file_leave_application;
        $leave->file_proof = $file_proof;
        $leave->is_rejected = FALSE;
        $leave->is_deleted = FALSE;
        $save = $leave->save();

        if($save){
            Alert::success('Berhasil', 'Permohonan Cuti Berhasil Dibuat');
            return redirect()->route('teacherlp');
        } else {
            Alert::error('Gagal', 'Gagal Membuat Permohonan Cuti! Silahkan ulangi beberapa saat lagi');
            return redirect()->route('teacherlpcreate');
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
      $data=LeavePermissions::where('id', $id)->first();
      return view('teacher/leavepermission/show', compact('data'));
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
