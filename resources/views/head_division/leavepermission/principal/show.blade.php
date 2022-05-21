@extends('layouts.divisionhead')
@section('content')
<div class="min-h-screen bg-gray-200 py-14">
  <div class="px-5 mx-auto max-w-7x1">
    <h1 class="mb-12 text-center text-4xl text-black font-bold">Data Pengajuan Cuti</h1>
    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
      <div class="w-full overflow-x-auto">
        <table class="w-full">
          <tbody class="bg-white">
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">Nama</td>
              <td class="px-4 py-3 text-ms border font-semibold">:</td>
              <td class="px-4 py-3 text-ms border">{{$data->user->personalData->name}}</td>
            </tr>
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">NIP</td>
              <td class="px-4 py-3 text-ms border font-semibold">:</td>
              <td class="px-4 py-3 text-ms border">{{$data->user->personalData->registration_number}}</td>
            </tr>
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">Jenis Cuti</td>
              <td class="px-4 py-3 text-ms border font-semibold">:</td>
              <td class="px-4 py-3 text-ms border">{{$data->leaveType->name}}</td>
            </tr>
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">Lama Cuti</td>
              <td class="px-4 py-3 text-ms border font-semibold">:</td>
              <td class="px-4 py-3 text-ms border">{{$data->leave_duration}} Hari</td>
            </tr>
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">Tanggal Mulai</td>
              <td class="px-4 py-3 text-ms border font-semibold">:</td>
              <td class="px-4 py-3 text-ms border">{{$data->start_date->formatLocalized('%d/%m/%Y')}}</td>
            </tr>
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">Tanggal Selesai</td>
              <td class="px-4 py-3 text-ms border font-semibold">:</td>
              <td class="px-4 py-3 text-ms border">{{$data->end_date->formatLocalized('%d/%m/%Y')}}</td>
            </tr>
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">Alamat Selama Cuti</td>
              <td class="px-4 py-3 text-ms border font-semibold">:</td>
              <td class="px-4 py-3 text-ms border">{{$data->leave_address}}</td>
            </tr>
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">File Surat Rekomendasi</td>
              <td class="px-4 py-3 text-ms border font-semibold">:</td>
              <td class="px-4 py-3 text-ms border text-blue-500 hover:text-blue-400">
                <a href="{{ asset('storage/leavepermission/' . $data->file_recommendation_letter) }}">{{$data->file_recommendation_letter}}</a>
              </td>
            </tr>
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">File Surat Permohonan</td>
              <td class="px-4 py-3 text-ms border font-semibold">:</td>
              <td class="px-4 py-3 text-ms border text-blue-500 hover:text-blue-400">
                <a href="{{ asset('storage/leavepermission/' . $data->file_leave_application) }}">{{$data->file_leave_application}}</a>
              </td>
            </tr>
            @if($data->file_temporary_permission != null)
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">File Surat Ijin Sementara</td>
              <td class="px-4 py-3 text-ms border font-semibold">:</td>
              <td class="px-4 py-3 text-ms border text-blue-500 hover:text-blue-400">
                <a href="{{ asset('storage/leavepermission/' . $data->file_temporary_permission) }}">{{$data->file_temporary_permission}}</a>
              </td>
            </tr>
            @endif
            @if($data->file_proof != null)
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">File Bukti Lainnya</td>
              <td class="px-4 py-3 text-ms border font-semibold">:</td>
              <td class="px-4 py-3 text-ms border text-blue-500 hover:text-blue-400">
                <a href="{{ asset('storage/leavepermission/' . $data->file_proof) }}">{{$data->file_proof}}</a>
              </td>
            </tr>
            @endif
          </tbody>
        </table>
      </div>
      <div class="w-full overflow-x-auto mt-10">
        <table class="w-full">
          <thead>
            <tr class="text-md text-center font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
              <th class="px-4 py-3" colspan="4">Cuti Sebelumnya</th>
            </tr>
            <tr class="text-md text-center font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
              <th class="px-4 py-3">No</th>
              <th class="px-4 py-3">Jenis Cuti</th>
              <th class="px-4 py-3">Tanggal Cuti</th>
              <th class="px-4 py-3">Lama Cuti</th>
            </tr>
          </thead>
          <tbody class="bg-white">
            @foreach($prevleaves as $prevleave)
            @if($prevleave->id != $data->id)
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">{{$loop->iteration}}</td>
              <td class="px-4 py-3 text-ms border">{{$prevleave->leaveType->name}}</td>
              <td class="px-4 py-3 text-ms border">{{$data->start_date->formatLocalized('%d/%m/%Y')}} - {{$data->end_date->formatLocalized('%d/%m/%Y')}}</td>
              <td class="px-4 py-3 text-ms border">{{$prevleave->leave_duration}} Hari</td>
            </tr>
            @else
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold" colspan="4">Belum Ada Data Cuti</td>
            </tr>
            @endif
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    @if(session('errors'))
    @foreach ($errors->all() as $error)
    <div class="bg-red-200 px-6 py-4 mx-2 my-4 rounded-md text-lg flex items-center">
      <svg viewBox="0 0 24 24" class="text-red-600 w-5 h-5 sm:w-5 sm:h-5 mr-3">
        <path fill="currentColor"  d="M11.983,0a12.206,12.206,0,0,0-8.51,3.653A11.8,11.8,0,0,0,0,12.207,11.779,11.779,0,0,0,11.8,24h.214A12.111,12.111,0,0,0,24,11.791h0A11.766,11.766,0,0,0,11.983,0ZM10.5,16.542a1.476,1.476,0,0,1,1.449-1.53h.027a1.527,1.527,0,0,1,1.523,1.47,1.475,1.475,0,0,1-1.449,1.53h-.027A1.529,1.529,0,0,1,10.5,16.542ZM11,12.5v-6a1,1,0,0,1,2,0v6a1,1,0,1,1-2,0Z"></path>
      </svg>
      <span class="text-red-800">{{ $error }}</span>
    </div>
    @endforeach
    @endif
    <div class="flex items-center justify-center mt-10">
      <div class="w-full max-w-md mr-4">
        <form action="{{ route('divheadprlpapprove', $data->id)}}" method="POST" class="bg-white shadow-lg rounded px-12 pt-6 pb-8 mb-4 border-2 border-green-500">
          @csrf
          <div class="text-gray-800 text-2xl flex justify-center border-b-2 py-2 mb-4">
            Setujui Cuti
          </div>
          <div class="mb-6">
            <label class="block text-gray-700 text-sm font-normal mb-2" for="password">
              Catatan
            </label>
            <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" name="official_note"/></textarea>
          </div>
          <div class="flex items-center justify-center">
            <button class="shadow bg-green-600 hover:bg-green-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
              Setujui
            </button>
          </div>
        </form>
      </div>
      <div class="w-full max-w-md">
        <form action="{{ route('divheadprlpreject', $data->id)}}" method="POST" class="bg-white shadow-lg rounded px-12 pt-6 pb-8 mb-4 border-2 border-red-500">
          @csrf
          <div class="text-gray-800 text-2xl flex justify-center border-b-2 py-2 mb-4">
            Tolak Cuti
          </div>
          <div class="mb-6">
            <label class="block text-gray-700 text-sm font-normal mb-2" for="password">
              Alasan Penolakan
            </label>
            <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" name="official_note"/></textarea>
          </div>
          <div class="flex items-center justify-center">
            <button class="shadow bg-red-600 hover:bg-red-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
              Tolak
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
@endsection
