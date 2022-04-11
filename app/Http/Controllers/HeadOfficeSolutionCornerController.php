<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\SolutionCorner;
use App\Models\User;
use Validator;
use Alert;
use Carbon\Carbon;

class HeadOfficeSolutionCornerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $user_id = auth()->user()->id;
      $datas=SolutionCorner::where(['handles_id' => $user_id, 'is_deleted' => FALSE, 'is_finish' => FALSE])->get();
      $finished=SolutionCorner::where(['is_deleted' => FALSE, 'is_finish' => TRUE])->get();
      return view('head_office/solutioncorner/index', compact('datas', 'finished'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $data=SolutionCorner::where('id', $id)->first();
      return view('head_office/solutioncorner/show', compact('data'));
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
        $rules = [
          'note' => 'required'
        ];

        $messages = [
          'note.required' => 'Catatan Wajib Diisi'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
          return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        DB::table('solution_corner')->whereId($id)->update([
          'is_finish'   => TRUE,
          'note'        => $request->note
        ]);

        Alert::success('Berhasil', 'Pojok Solusi Selesai');
        return redirect()->route('officeheadsc');
    }
}
