@extends('layouts.headoffice')
@section('content')
<div class="min-h-screen bg-blue-200 py-3">
  <a href="/officehead">
    <button class="block text-green-500 rounded-sm font-bold py-4 px-6 mr-2 flex items-center hover:bg-green-500 hover:text-white">
      <svg class="h-5 w-5 mr-2 fill-current" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="-49 141 512 512" style="enable-background:new -49 141 512 512;" xml:space="preserve">
        <path id="XMLID_10_" d="M438,372H36.355l72.822-72.822c9.763-9.763,9.763-25.592,0-35.355c-9.763-9.764-25.593-9.762-35.355,0 l-115.5,115.5C-46.366,384.01-49,390.369-49,397s2.634,12.989,7.322,17.678l115.5,115.5c9.763,9.762,25.593,9.763,35.355,0 c9.763-9.763,9.763-25.592,0-35.355L36.355,422H438c13.808,0,25-11.193,25-25S451.808,372,438,372z"></path>
      </svg>
    </button>
  </a>
  <div class="px-5 mx-auto max-w-7x1">
    <h1 class="mb-12 text-center text-4xl text-black font-bold">Pengajuan Cuti Menunggu Diperiksa</h1>
    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
    <div class="w-full overflow-x-auto">
      <table class="w-full">
        <thead>
          <tr class="text-md text-center font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
            <th class="px-4 py-3">No</th>
            <th class="px-4 py-3">Nama</th>
            <th class="px-4 py-3">Unit Kerja</th>
            <th class="px-4 py-3">Jenis Cuti</th>
            <th class="px-4 py-3">Lama Cuti</th>
            <th class="px-4 py-3">Tanggal Cuti</th>
            <th class="px-4 py-3">Alasan</th>
            <th class="px-4 py-3">Aksi</th>
          </tr>
        </thead>
        <tbody class="bg-white">
          @foreach($datas as $data)
          @if($data->user->role->name == "Kepala Sekolah")
          <tr class="text-gray-700 text-center">
            <td class="px-4 py-3 text-ms border font-semibold">{{$loop->iteration}}</td>
            <td class="px-4 py-3 text-ms border">{{$data->user->personalData->name}}</td>
            <td class="px-4 py-3 text-ms border">{{$data->user->personalData->workUnit->name}}</td>
            <td class="px-4 py-3 text-ms border">{{$data->leaveType->name}}</td>
            <td class="px-4 py-3 text-ms border">{{$data->leave_duration}} Hari</td>
            <td class="px-4 py-3 text-ms border">{{$data->start_date->formatLocalized("%d/%m/%Y")}} - {{$data->end_date->formatLocalized("%d/%m/%Y")}}</td>
            <td class="px-4 py-3 text-ms border">{!! $data->leave_excuse !!}</td>
            <td class="px-4 py-3 text-ms border">
              <a href="{{ url ('/officehead/leavepermission/show', array("$data->id")) }}" class="text-green-600 hover:text-green-400 mr-2">
                <i class="material-icons-outlined text-base">visibility</i>
              </a>
            </td>
          </tr>
          @endif
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  <h1 class="mb-12 text-center text-4xl text-black font-bold">Daftar Pengajuan Cuti</h1>
  <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
  <div class="w-full overflow-x-auto">
    <table class="w-full">
      <thead>
        <tr class="text-md text-center font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
          <th class="px-4 py-3">No</th>
          <th class="px-4 py-3">Nama</th>
          <th class="px-4 py-3">Unit Kerja</th>
          <th class="px-4 py-3">Jenis Cuti</th>
          <th class="px-4 py-3">Lama Cuti</th>
          <th class="px-4 py-3">Tanggal Cuti</th>
          <th class="px-4 py-3">Alasan</th>
          <th class="px-4 py-3">Status</th>
        </tr>
      </thead>
      <tbody class="bg-white">
        @foreach($all_datas as $all_data)
        <tr class="text-gray-700 text-center">
          <td class="px-4 py-3 text-ms border font-semibold">{{$loop->iteration}}</td>
          <td class="px-4 py-3 text-ms border">{{$all_data->user->personalData->name}}</td>
          <td class="px-4 py-3 text-ms border">{{$all_data->user->personalData->position->name}} - {{$all_data->user->personalData->workUnit->name}}</td>
          <td class="px-4 py-3 text-ms border">{{$all_data->leaveType->name}}</td>
          <td class="px-4 py-3 text-ms border">{{$all_data->leave_duration}} Hari</td>
          <td class="px-4 py-3 text-ms border">{{$all_data->start_date->formatLocalized("%d/%m/%Y")}} - {{$all_data->end_date->formatLocalized("%d/%m/%Y")}}</td>
          <td class="px-4 py-3 text-ms border">{!! $all_data->leave_excuse !!}</td>
          @if($all_data->is_direct_supervisor_approve == FALSE)
          <td class="px-4 py-3 text-sm border">
            <span class="inline-block rounded-full text-white bg-yellow-500 px-2 py-1 text-xs font-bold mr-3">Belum Disetujui Kepala Sekolah</span>
          </td>
          @elseif($all_data->is_direct_supervisor_approve == TRUE && $all_data->is_official_approve == FALSE && $all_data->is_rejected == FALSE)
          <td class="px-4 py-3 text-sm border">
            <span class="inline-block rounded-full text-white bg-indigo-500 px-2 py-1 text-xs font-bold mr-3">Menunggu Persetujuan Kepala Bidang</span>
          </td>
          @elseif($all_data->is_direct_supervisor_approve == TRUE && $all_data->is_official_approve == TRUE)
          <td class="px-4 py-3 text-sm border">
            <span class="inline-block rounded-full text-white bg-green-500 px-2 py-1 text-xs font-bold mr-3">Pengajuan Disetujui</span>
          </td>
          @elseif($all_data->is_rejected == TRUE)
          <td class="px-4 py-3 text-sm border">
            <span class="inline-block rounded-full text-white bg-red-500 px-2 py-1 text-xs font-bold mr-3">Pengajuan Ditolak</span>
          </td>
          @endif
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
  </div>
</div>
@endsection
