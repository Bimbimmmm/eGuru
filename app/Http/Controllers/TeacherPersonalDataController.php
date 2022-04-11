<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PersonalData;
use App\Models\DataFormalEducationHistory;
use App\Models\DataNonFormalEducationHistory;
use App\Models\DataPostionHistory;
use App\Models\DataRankHistory;
use App\Models\DataSalaryIncreaseHistory;
use App\Models\DataAppreciationHistory;
use Validator;
use Alert;

class TeacherPersonalDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reg = auth()->user()->registration_number;
        $id = auth()->user()->personal_data_id;
        $user_id = auth()->user()->id;
        $data=PersonalData::where(['registration_number' => $reg, 'id' => $id])->first();
        $fehdatas=DataFormalEducationHistory::where(['user_id' => $user_id, 'is_deleted' => FALSE])->get();
        $nfehdatas=DataNonFormalEducationHistory::where(['user_id' => $user_id, 'is_deleted' => FALSE])->get();
        $rhdatas=DataRankHistory::where(['user_id' => $user_id, 'is_deleted' => FALSE])->get();
        $sihdatas=DataSalaryIncreaseHistory::where(['user_id' => $user_id, 'is_deleted' => FALSE])->get();
        $ahdatas=DataAppreciationHistory::where(['user_id' => $user_id, 'is_deleted' => FALSE])->get();
        $phdatas=DataPostionHistory::where(['user_id' => $user_id, 'is_deleted' => FALSE])->get();
        return view('teacher/personaldata/index', compact('data', 'fehdatas', 'nfehdatas', 'rhdatas', 'sihdatas', 'ahdatas', 'phdatas'));
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
