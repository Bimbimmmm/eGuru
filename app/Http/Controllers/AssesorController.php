<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewAssesmentCredit;
use App\Models\NewPromotion;

class AssesorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $count_ac_nf=NewAssesmentCredit::where(['is_ready' => TRUE, 'is_finished' => FALSE, 'is_deleted' => FALSE])->count();
        $count_ac_f=NewAssesmentCredit::where(['is_ready' => TRUE,'is_deleted' => FALSE])->count();
        $count_pr_nf=NewPromotion::where(['is_locked' => TRUE, 'is_finish' => FALSE, 'is_deleted' => FALSE])->count();
        $count_pr_f=NewPromotion::where(['is_locked' => TRUE,'is_deleted' => FALSE])->count();
        return view('assesor/index', compact('count_ac_nf', 'count_ac_f', 'count_pr_nf', 'count_pr_f'));
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
