@extends('layouts.teacher')
@section('content')
<div class="min-h-screen bg-blue-200 py-3">
  <div class="px-5 mx-auto max-w-7x1">
    <a href="/teacher">
      <button class="block text-green-500 rounded-sm font-bold py-4 px-6 mr-2 flex items-center hover:bg-green-500 hover:text-white">
        <svg class="h-5 w-5 mr-2 fill-current" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="-49 141 512 512" style="enable-background:new -49 141 512 512;" xml:space="preserve">
          <path id="XMLID_10_" d="M438,372H36.355l72.822-72.822c9.763-9.763,9.763-25.592,0-35.355c-9.763-9.764-25.593-9.762-35.355,0 l-115.5,115.5C-46.366,384.01-49,390.369-49,397s2.634,12.989,7.322,17.678l115.5,115.5c9.763,9.762,25.593,9.763,35.355,0 c9.763-9.763,9.763-25.592,0-35.355L36.355,422H438c13.808,0,25-11.193,25-25S451.808,372,438,372z"></path>
        </svg>
      </button>
    </a>
    <h1 class="mb-12 text-center text-4xl text-black font-bold">Pengajuan Cuti</h1>
    <div class="w-40">
      <div class="my-2 flex sm:flex-row flex-col">
        <div class="block relative">
          <a class="text-white" href="/teacher/leavepermission/create">
            <div class="flex items-center p-4 bg-green-500 rounded-lg shadow-xs cursor-pointer hover:bg-green-400 hover:text-gray-100">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
              </svg>
              <div>
                <p class=" text-xs font-bold ml-2 ">
                  AJUKAN CUTI
                </p>
              </div>
            </div>
          </a>
        </div>
      </div>
    </div>
    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
    <div class="w-full overflow-x-auto">
      <table class="w-full">
        <thead>
          <tr class="text-md text-center font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
            <th class="px-4 py-3">No</th>
            <th class="px-4 py-3">Jenis Cuti</th>
            <th class="px-4 py-3">Lama Cuti</th>
            <th class="px-4 py-3">Tanggal Selesai Cuti</th>
            <th class="px-4 py-3">Alasan</th>
            <th class="px-4 py-3">Status</th>
            <th class="px-4 py-3">Aksi</th>
          </tr>
        </thead>
        <tbody class="bg-white">
          @foreach($datas as $data)
          <tr class="text-gray-700 text-center">
            <td class="px-4 py-3 text-ms border font-semibold">{{$loop->iteration}}</td>
            <td class="px-4 py-3 text-ms border">{{$data->leaveType->name}}</td>
            <td class="px-4 py-3 text-ms border">{{$data->leave_duration}} Hari</td>
            <td class="px-4 py-3 text-sm border">{{$data->end_date->formatLocalized("%d/%m/%Y")}}</td>
            <td class="px-4 py-3 text-sm border">{!! $data->leave_excuse !!}</td>
            @if($data->is_direct_supervisor_approve == FALSE)
            <td class="px-4 py-3 text-sm border">
              <span class="inline-block rounded-full text-white bg-yellow-500 px-2 py-1 text-xs font-bold mr-3">Belum Disetujui Kepala Sekolah</span>
            </td>
            @elseif($data->is_direct_supervisor_approve == TRUE && $data->is_official_approve == FALSE && $data->is_rejected == FALSE)
            <td class="px-4 py-3 text-sm border">
              <span class="inline-block rounded-full text-white bg-indigo-500 px-2 py-1 text-xs font-bold mr-3">Menunggu Persetujuan Kepala Bidang</span>
            </td>
            @elseif($data->is_direct_supervisor_approve == TRUE && $data->is_official_approve == TRUE)
            <td class="px-4 py-3 text-sm border">
              <span class="inline-block rounded-full text-white bg-green-500 px-2 py-1 text-xs font-bold mr-3">Pengajuan Disetujui</span>
            </td>
            @elseif($data->is_rejected == TRUE)
            <td class="px-4 py-3 text-sm border">
              <span class="inline-block rounded-full text-white bg-red-500 px-2 py-1 text-xs font-bold mr-3">Pengajuan Ditolak</span>
            </td>
            @endif
            <td class="px-4 py-3 text-sm border">
              <a href="{{ url ('/teacher/leavepermission/show', array("$data->id")) }}" class="text-green-600 hover:text-green-400 mr-2">
                <i class="material-icons-outlined text-base">visibility</i>
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  </div>
</div>
@endsection
