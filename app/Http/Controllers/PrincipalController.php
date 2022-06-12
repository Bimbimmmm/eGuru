<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PositionMapping;
use App\Models\LeavePermissions;
use App\Models\PrincipalMapping;
use App\Models\SolutionCorner;
use App\Models\SalaryIncrease;
use App\Models\NewPerformanceTarget;
use App\Models\NewAssesmentCredit;
use App\Models\NewPromotion;
use App\Models\PersonalData;

class PrincipalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $user_id = auth()->user()->id;
      $position_mapping=PositionMapping::where(['principal_id' => $user_id, 'is_active' => TRUE])->first();
      $is_integration=User::where(['id' => $user_id, 'personal_data_id' => NULL])->count();
      $leavepermission=LeavePermissions::where('user_id', $user_id)->count();
      $performancetarget=NewPerformanceTarget::where(['position_mapping_id' => $position_mapping->id, 'is_ready' => TRUE, 'is_direct_supervisor_approve' => FALSE, 'is_deleted' => FALSE])->count();
      $mapping=PrincipalMapping::where(['user_id' => $user_id, 'is_deleted' => FALSE])->count();
      $solutioncorner=SolutionCorner::where(['user_id' => $user_id, 'is_deleted' => FALSE])->count();
      $salaryincrease=SalaryIncrease::where(['user_id' => $user_id, 'is_deleted' => FALSE])->count();
      $data_cs=[];
      $pdid = auth()->user()->personal_data_id;
      $i=0;
      $pd=PersonalData::where('id', $pdid)->first();
      $datas=NewAssesmentCredit::where(['is_official_approve' => TRUE, 'is_deleted' => FALSE])->get();
      foreach ($datas as $data) {
        $dat=$data->user->personal_data_id;
        $p=PersonalData::where('id', $dat)->first();
        if($pd->work_unit_id == $p->work_unit_id){
          $data_cs[$i]=$data;
        }
        $i=$i+1;
      }
      $data_cs_count=count($data_cs);
      $data_pr=[];
      $pdid = auth()->user()->personal_data_id;
      $i=0;
      $pd=PersonalData::where('id', $pdid)->first();
      $datas=NewPromotion::where(['is_finish' => TRUE, 'is_deleted' => FALSE])->get();
      foreach ($datas as $data) {
        $dat=$data->user->personal_data_id;
        $p=PersonalData::where('id', $dat)->first();
        if($pd->work_unit_id == $p->work_unit_id){
          $data_pr[$i]=$data;
        }
        $i=$i+1;
      }
      $data_pr_count=count($data_pr);
      return view('principal/index', compact('is_integration', 'leavepermission', 'mapping', 'solutioncorner', 'salaryincrease', 'performancetarget', 'data_cs_count', 'data_pr_count'));
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
