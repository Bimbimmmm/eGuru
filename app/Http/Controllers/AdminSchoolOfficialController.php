<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SchoolOfficial;
use App\Models\ReferenceWorkUnits;
use App\Models\User;
use Validator;
use Alert;
class AdminSchoolOfficialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas=SchoolOfficial::where('is_deleted', FALSE)->get();
        return view('administrator/references/schoolofficial/index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $workunits=ReferenceWorkUnits::all();
        $principals=User::where('role_id', '3a0bb24e-e922-4c99-95ea-7b5346a70742')->get();
        return view('administrator/references/schoolofficial/create', compact('workunits', 'principals'));
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
            'user_id'        => 'required',
            'work_unit_id'   => 'required',
        ];

        $messages = [
            'user_id.required'       => 'Nama Wajib Diisi',
            'work_unit_id.required'  => 'Unit Kerja wajib diisi',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $data = new SchoolOfficial;
        $data->user_id = $request->user_id;
        $data->work_unit_id = $request->work_unit_id;
        $data->is_active = TRUE;
        $data->is_deleted = FALSE;
        $save = $data->save();

        if($save){
            Alert::success('Berhasil', 'Kepala Sekolah Berhasil Ditugaskan');
            return redirect()->route('adminschoff');
        } else {
            Alert::error('Gagal', 'Gagal Menugaskan Kepala Sekolah! Silahkan ulangi beberapa saat lagi');
            return redirect()->route('adminschoffcreate');
        }
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
