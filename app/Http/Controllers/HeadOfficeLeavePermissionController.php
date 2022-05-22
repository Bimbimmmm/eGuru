<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\LeavePermissions;
use App\Models\PositionMapping;
use App\Models\DecreeNumber;
use Validator;
use Alert;


class HeadOfficeLeavePermissionController extends Controller
{
  public function index()
  {
    $user_id = auth()->user()->id;
    $datas=LeavePermissions::where(['is_direct_supervisor_approve' => TRUE, 'is_official_approve' => FALSE, 'is_rejected' => FALSE])->latest()->get();
    $all_datas=LeavePermissions::where(['is_deleted' => FALSE])->latest()->get();
    return view('head_office/leavepermission/index', compact('datas', 'all_datas'));
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
    $prevleaves=LeavePermissions::where('user_id', $data->user_id)->get();
    return view('head_office/leavepermission/show', compact('data', 'prevleaves'));
  }

  public function approve(Request $request, $id)
  {
    $rules = [
      'official_note'                 => 'required'
    ];

    $messages = [
      'official_note.required'        => 'Catatan Wajib Diberikan'
    ];

    $validator = Validator::make($request->all(), $rules, $messages);

    date_default_timezone_set('Asia/Makassar');
    $month=date('m');
    $year=date('Y');
    $month_decree= "null";
    if($month === 1){
      $month_decree="I";
    }else if($month == 2){
      $month_decree="II";
    }else if($month == 3){
      $month_decree="III";
    }else if($month == 4){
      $month_decree="IV";
    }else if($month == 5){
      $month_decree="V";
    }else if($month == 6){
      $month_decree="VI";
    }else if($month == 7){
      $month_decree="VII";
    }else if($month == 8){
      $month_decree="VIII";
    }else if($month == 9){
      $month_decree="IX";
    }else if($month == 10){
      $month_decree="X";
    }else if($month == 11){
      $month_decree="XI";
    }else if($month == 12){
      $month_decree="XII";
    }

    $name = auth()->user()->personalData->name;

    $data = new DecreeNumber;
    $data->type = "Surat Pengajuan Cuti";
    $data->leave_permissions_id = $id;
    $data->month = $month_decree;
    $data->year = $year;
    $data->assesed_by = $name;
    $save = $data->save();

    DB::table('leave_permissions')->whereId($id)->update([
      'is_official_approve'  => TRUE,
      'official_note'        => $request->official_note
    ]);

    Alert::success('Berhasil', 'Cuti Berhasil Diproses');
    return redirect()->route('officeheadlp');
  }

  public function reject(Request $request, $id)
  {

    $rules = [
      'official_note'                 => 'required'
    ];

    $messages = [
      'official_note.required'        => 'Catatan Wajib Diberikan'
    ];

    $validator = Validator::make($request->all(), $rules, $messages);

    DB::table('leave_permissions')->whereId($id)->update([
      'is_rejected'      => TRUE,
      'official_note'    => $request->official_note
    ]);

    Alert::success('Berhasil', 'Cuti Ditolak');
    return redirect()->route('officeheadlp');
  }
}
