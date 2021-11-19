<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PositionMapping;
use App\Models\ReferenceWorkUnits;
use App\Models\User;
use App\Models\Roles;
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
        $datas=PositionMapping::where('is_deleted', FALSE)->get();
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
        $principal_role=Roles::where('name', 'Kepala Sekolah')->first();
        $official_role=Roles::where('name', 'Kepala Bidang')->first();
        $principals=User::where('role_id', $principal_role->id)->get();
        $officials=User::where('role_id', $official_role->id)->get();
        return view('administrator/references/schoolofficial/create', compact('workunits', 'principals', 'officials'));
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
            'principal_id'   => 'required',
            'work_unit_id'   => 'required',
            'supervisor_id'  => 'required'
        ];

        $messages = [
            'principal_id.required'  => 'Nama Kepala Sekolah Wajib Diisi',
            'work_unit_id.required'  => 'Unit Kerja wajib diisi',
            'supervisor_id.required' => 'Nama Kepala Bidang wajib diisi'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $data = new PositionMapping;
        $data->principal_id = $request->principal_id;
        $data->work_unit_id = $request->work_unit_id;
        $data->supervisor_id = $request->supervisor_id;
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
