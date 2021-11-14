@extends('layouts.divisionhead')
@section('content')
<div class="min-h-screen bg-blue-200 py-14">
  <div class="px-5 mx-auto max-w-7x1">
    <h1 class="mb-12 text-center text-4xl text-black font-bold">Pengajuan Cuti</h1>
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
          <tr class="text-gray-700 text-center">
            <td class="px-4 py-3 text-ms border font-semibold">{{$loop->iteration}}</td>
            <td class="px-4 py-3 text-ms border">{{$data->user->personalData->name}}</td>
            <td class="px-4 py-3 text-ms border">{{$data->user->personalData->workUnit->name}}</td>
            <td class="px-4 py-3 text-ms border">{{$data->leaveType->name}}</td>
            <td class="px-4 py-3 text-ms border">{{$data->leave_duration}} Hari</td>
            <td class="px-4 py-3 text-ms border">{{$data->start_date->formatLocalized("%d/%m/%Y")}} - {{$data->end_date->formatLocalized("%d/%m/%Y")}}</td>
            <td class="px-4 py-3 text-ms border">{!! $data->leave_excuse !!}</td>
            <td class="px-4 py-3 text-ms border">
              <a href="{{ url ('/divisionhead/leavepermission/show', array("$data->id")) }}" class="text-green-600 hover:text-green-400 mr-2">
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
