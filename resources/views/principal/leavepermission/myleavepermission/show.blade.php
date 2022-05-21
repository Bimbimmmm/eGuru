@extends('layouts.principal')
@section('content')
<div class="min-h-screen bg-gray-200 py-3">
  <a href="/principal/leavepermission">
    <button class="block text-green-500 rounded-sm font-bold py-4 px-6 mr-2 flex items-center hover:bg-green-500 hover:text-white">
      <svg class="h-5 w-5 mr-2 fill-current" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="-49 141 512 512" style="enable-background:new -49 141 512 512;" xml:space="preserve">
        <path id="XMLID_10_" d="M438,372H36.355l72.822-72.822c9.763-9.763,9.763-25.592,0-35.355c-9.763-9.764-25.593-9.762-35.355,0 l-115.5,115.5C-46.366,384.01-49,390.369-49,397s2.634,12.989,7.322,17.678l115.5,115.5c9.763,9.762,25.593,9.763,35.355,0 c9.763-9.763,9.763-25.592,0-35.355L36.355,422H438c13.808,0,25-11.193,25-25S451.808,372,438,372z"></path>
      </svg>
    </button>
  </a>
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
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">Status</td>
              <td class="px-4 py-3 text-ms border font-semibold">:</td>
              @if($data->is_direct_supervisor_approve == FALSE)
              <td class="px-4 py-3 text-ms border text-blue-500 hover:text-blue-400">
                <a>
                  <span class="inline-block rounded-full text-white bg-yellow-500 px-2 py-1 text-xs font-bold mr-3">Belum Disetujui Kepala Bidang</span>
                </a>
              </td>
              @elseif($data->is_direct_supervisor_approve == TRUE && $data->is_official_approve == FALSE && $data->is_rejected == FALSE)
              <td class="px-4 py-3 text-ms border text-blue-500 hover:text-blue-400">
                <a>
                  <span class="inline-block rounded-full text-white bg-indigo-500 px-2 py-1 text-xs font-bold mr-3">Menunggu Persetujuan Kepala Dinas</span>
                </a>
              </td>
              @elseif($data->is_direct_supervisor_approve == TRUE && $data->is_official_approve == TRUE)
              <td class="px-4 py-3 text-ms border text-blue-500 hover:text-blue-400">
                <a>
                  <span class="inline-block rounded-full text-white bg-green-500 px-2 py-1 text-xs font-bold mr-3">Pengajuan Disetujui</span>
                </a>
                <a href="{{ url ('/principal/myleavepermission/pdf', array("$data->id")) }}">
                  <span class="inline-block rounded-full text-white bg-green-500 px-2 py-1 text-xs font-bold mr-3">File PDF Tersedia</span>
                </a>
              </td>
              @elseif($data->is_rejected == TRUE)
              <td class="px-4 py-3 text-ms border text-blue-500 hover:text-blue-400">
                <a>
                  <span class="inline-block rounded-full text-white bg-red-500 px-2 py-1 text-xs font-bold mr-3">Pengajuan Ditolak</span>
                </a>
              </td>
              @endif
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
</div>
@endsection
