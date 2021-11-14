<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\LeavePermissions;
use App\Models\SchoolOfficial;
use Validator;
use Alert;

class PrincipalLeavePermissionController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    $user_id = auth()->user()->id;
    $myoffical=SchoolOfficial::where('user_id', $user_id)->first();
    $datas=LeavePermissions::where(['school_official_id' => $myoffical->id, 'is_direct_supervisor_approve' => FALSE])->latest()->get();
    return view('principal/leavepermission/index', compact('datas'));
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    //
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {
    //
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
    return view('principal/leavepermission/show', compact('data', 'prevleaves'));
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
    return redirect()->route('principallp');
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
    return redirect()->route('principallp');
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