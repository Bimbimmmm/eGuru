<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReferenceWorkUnits;
use App\Models\Provinces;
use App\Models\Cities;
use App\Models\Districts;
use App\Models\Villages;
use Validator;
use Alert;

class AdminReferenceSchoolController extends Controller
{
  public function index()
  {
    $datas=ReferenceWorkUnits::where('is_deleted', FALSE)->get();
    return view('administrator/references/workunit/index', compact('datas'));
  }

  public function create()
  {
    $provinces=Provinces::all();
    return view('administrator/references/workunit/create', compact('provinces'));
  }

  public function store(Request $request)
  {
    $rules = [
          'name'                  => 'required',
          'address'               => 'required',
          'zip_code'              => 'required',
          'province'              => 'required',
          'city'                  => 'required',
          'district'              => 'required',
          'village'               => 'required'
      ];

      $messages = [
          'name.required'                 => 'Nama Wajib Diisi',
          'zip_code.required'             => 'Kode POS wajib diisi',
          'address.required'              => 'Alamat wajib diisi',
          'province.required'             => 'Provinsi wajib diisi',
          'city.required'                 => 'Kota wajib diisi',
          'district.required'             => 'Kecamatan wajib diisi',
          'village.required'              => 'Kelurahan / Desa wajib diisi',
      ];

      $validator = Validator::make($request->all(), $rules, $messages);

      if($validator->fails()){
          return redirect()->back()->withErrors($validator)->withInput($request->all);
      }

      $get_province = Provinces::where('code', $request->province)->first();
      $get_city = Cities::where('code', $request->city)->first();
      $get_district = Districts::where('code', $request->district)->first();
      $get_village = Villages::where('code', $request->village)->first();

      $data = new ReferenceWorkUnits;
      $data->name = $request->name;
      $data->address = $request->address;
      $data->zip_code = $request->zip_code;
      $data->province = $get_province->name;
      $data->city = $get_city->name;
      $data->district = $get_district->name;
      $data->village = $get_village->name;
      $data->is_deleted = FALSE;
      $save = $data->save();

      if($save){
          Alert::success('Berhasil', 'Unit Kerja Berhasil Ditambahkan');
          return redirect()->route('adminrefwo');
      } else {
          Alert::error('Gagal', 'Gagal Menambah Unit Kerja! Silahkan ulangi beberapa saat lagi');
          return redirect()->route('adminrefwocreate');
      }
  }

  public function destroy($id)
  {
    $data = ReferenceWorkUnits::findOrFail($id);
    $data->update([
        'is_deleted' => TRUE
    ]);

    if($data){
          Alert::success('Berhasil', 'Unit Kerja Berhasil Dihapus');
          return redirect()->back();
    } else {
          Alert::error('Gagal', 'Gagal Menghapus Unit Kerja! Silahkan ulangi beberapa saat lagi');
          return redirect()->back();
    }
  }
}
