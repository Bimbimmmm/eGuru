<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\LeavePermissions;
use App\Models\PositionMapping;
use Validator;
use Alert;

class DivisionHeadPrincipalLeavePermissionController extends Controller
{
  public function show($id)
  {
    $data=LeavePermissions::where('id', $id)->first();
    $prevleaves=LeavePermissions::where('user_id', $data->user_id)->get();
    return view('head_division/leavepermission/principal/show', compact('data', 'prevleaves'));
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

    DB::table('leave_permissions')->whereId($id)->update([
      'is_direct_supervisor_approve'  => TRUE,
      'direct_supervisor_note'        => $request->official_note
    ]);

    Alert::success('Berhasil', 'Cuti Berhasil Diproses');
    return redirect()->route('divheadlp');
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
      'is_rejected'               => TRUE,
      'direct_supervisor_note'    => $request->official_note
    ]);

    Alert::success('Berhasil', 'Cuti Ditolak');
    return redirect()->route('divheadlp');
  }
}
