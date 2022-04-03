<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\SolutionCorner;
use App\Models\User;
use Validator;
use Alert;
use Carbon\Carbon;

class TeacherSolutionCornerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $datas=SolutionCorner::where(['user_id' => $user_id, 'is_deleted' => FALSE])->get();
        return view('teacher/solutioncorner/index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $handles=User::where('is_deleted', FALSE)->get();
        return view('teacher/solutioncorner/create', compact('handles'));
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
        'confide_date'  => 'required',
        'problem'       => 'required',
        'handles_id'    => 'required'
      ];

      $messages = [
        'confide_date.required'   => 'Tanggal Rencana Pertemuan Wajib Dipilih',
        'problem.required'        => 'Permasalahan Wajib Diisi',
        'handles_id.required'     => 'Pejabat Tujuan Wajib Diisi'
      ];

      $validator = Validator::make($request->all(), $rules, $messages);

      if($validator->fails()){
        return redirect()->back()->withErrors($validator)->withInput($request->all);
      }

      $user_id = auth()->user()->id;

      $check=SolutionCorner::where(['user_id' => $user_id, 'satisfaction_level' => NULL, 'is_deleted' => FALSE])->count();

      if($check > 0){
        Alert::error('Gagal', 'Pertemuan Sebelumnya Belum Selesai / Diberi Feedback!');
        return redirect()->route('teachersc');
      }else{
        $confide_date=Carbon::parse($request->confide_date);
        $count=SolutionCorner::where('confide_date', $confide_date)->count();
        $my_queue=$count+1;

        $data = new SolutionCorner;
        $data->confide_date = $confide_date;
        $data->problem = $request->problem;
        $data->queue_number = $my_queue;
        $data->user_id = $user_id;
        $data->handles_id = $request->handles_id;
        $data->is_finish = FALSE;
        $data->is_deleted = FALSE;
        $save = $data->save();
      }

      Alert::success('Berhasil', 'Rencana Pertemuan Berhasil Dibuat');
      return redirect()->route('teachersc');

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
      return view('teacher/solutioncorner/show', compact('data'));
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
    public function feedback(Request $request, $id)
    {
      $rules = [
        'satisfaction_level'  => 'required',
        'feedback'            => 'required'
      ];

      $messages = [
        'satisfaction_level.required' => 'Tingkat Kepuasan Wajib Dipilih',
        'feedback.required'           => 'Feedback Wajib Diisi'
      ];

      $validator = Validator::make($request->all(), $rules, $messages);

      if($validator->fails()){
        return redirect()->back()->withErrors($validator)->withInput($request->all);
      }

      DB::table('solution_corner')->whereId($id)->update([
        'satisfaction_level'   => $request->satisfaction_level,
        'feedback'             => $request->feedback
      ]);

      Alert::success('Berhasil', 'Pojok Solusi Selesai');
      return redirect()->route('teachersc');
    }

}
