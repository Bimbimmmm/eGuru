<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReferenceSubject;
use Validator;
use Alert;

class AdminReferenceSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $datas=ReferenceSubject::where('is_deleted', FALSE)->get();
      return view('administrator/references/subject/index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('administrator/references/subject/create');
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
              'name'          => 'required',
              'subject_type'  => 'required',
              'lesson_level'  => 'required'
          ];

          $messages = [
              'name.required'          => 'Nama Mata Pelajaran Wajib Diisi',
              'subject_type.required'  => 'Jenis Mata Pelajaran Wajib Dipilih',
              'lesson_level.required'  => 'Level Mata Pelajaran Wajib Dipilih'
          ];

          $validator = Validator::make($request->all(), $rules, $messages);

          if($validator->fails()){
              return redirect()->back()->withErrors($validator)->withInput($request->all);
          }

          $data = new ReferenceSubject;
          $data->name = $request->name;
          $data->subject_type = $request->subject_type;
          $data->lesson_level = $request->lesson_level;
          $data->is_deleted = FALSE;
          $save = $data->save();

          if($save){
              Alert::success('Berhasil', 'Mata Pelajaran Berhasil Ditambahkan');
              return redirect()->route('adminrefs');
          } else {
              Alert::error('Gagal', 'Gagal Menambah Mata Pelajaran! Silahkan ulangi beberapa saat lagi');
              return redirect()->route('adminrefscreate');
          }
    }

  /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $data = ReferenceSubject::findOrFail($id);
      $data->update([
          'is_deleted' => TRUE
      ]);

      if($data){
            Alert::success('Berhasil', 'Mata Pelajaran Berhasil Dihapus');
            return redirect()->back();
      } else {
            Alert::error('Gagal', 'Gagal Menghapus Mata Pelajaran! Silahkan ulangi beberapa saat lagi');
            return redirect()->back();
      }
    }
}
