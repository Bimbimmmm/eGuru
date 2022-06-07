<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\LeavePermissions;
use App\Models\NewPerformanceTarget;
use App\Models\PositionMapping;
use App\Models\NewAssesmentCredit;

class HeadDivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $position_mapping=PositionMapping::where(['supervisor_id' => $user_id, 'is_active' => TRUE])->first();
        $is_integration=User::where(['id' => $user_id, 'personal_data_id' => NULL])->count();
        $leavepermission=LeavePermissions::where(['is_direct_supervisor_approve' => TRUE, 'is_official_approve' => FALSE, 'is_deleted' => FALSE])->count();
        $performancetarget=NewPerformanceTarget::where(['position_mapping_id' => $position_mapping->id, 'is_deleted' => FALSE, 'is_direct_supervisor_approve' => TRUE, 'is_official_approve' => FALSE, 'is_deleted' => FALSE])->count();
        $assesmentcredit=NewAssesmentCredit::where(['is_finished' => TRUE, 'is_official_approve' => FALSE, 'is_deleted' => FALSE])->count();
        return view('head_division/index', compact('is_integration', 'leavepermission', 'performancetarget', 'assesmentcredit'));
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
        //
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
