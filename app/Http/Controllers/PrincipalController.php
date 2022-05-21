<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\LeavePermissions;
use App\Models\PrincipalMapping;
use App\Models\SolutionCorner;
use App\Models\SalaryIncrease;

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
      $is_integration=User::where(['id' => $user_id, 'personal_data_id' => NULL])->count();
      $leavepermission=LeavePermissions::where('user_id', $user_id)->count();
      $mapping=PrincipalMapping::where(['user_id' => $user_id, 'is_deleted' => FALSE])->count();
      $solutioncorner=SolutionCorner::where(['user_id' => $user_id, 'is_deleted' => FALSE])->count();
      $salaryincrease=SalaryIncrease::where(['user_id' => $user_id, 'is_deleted' => FALSE])->count();
      return view('principal/index', compact('is_integration', 'leavepermission', 'mapping', 'solutioncorner', 'salaryincrease'));
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
