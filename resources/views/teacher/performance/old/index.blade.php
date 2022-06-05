@extends('layouts.teacher')
@section('content')
<div class="min-h-screen bg-gray-100 py-2">
  <div class="px-5 mx-auto max-w-7x1">
    <a href="/teacher">
      <button class="block text-green-500 rounded-sm font-bold py-4 px-6 mr-2 flex items-center hover:bg-green-500 hover:text-white">
        <svg class="h-5 w-5 mr-2 fill-current" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="-49 141 512 512" style="enable-background:new -49 141 512 512;" xml:space="preserve">
          <path id="XMLID_10_" d="M438,372H36.355l72.822-72.822c9.763-9.763,9.763-25.592,0-35.355c-9.763-9.764-25.593-9.762-35.355,0 l-115.5,115.5C-46.366,384.01-49,390.369-49,397s2.634,12.989,7.322,17.678l115.5,115.5c9.763,9.762,25.593,9.763,35.355,0 c9.763-9.763,9.763-25.592,0-35.355L36.355,422H438c13.808,0,25-11.193,25-25S451.808,372,438,372z"></path>
        </svg>
      </button>
    </a>
    <h1 class="mb-12 text-center text-4xl text-gray-500 font-bold">Sasaran Kinerja Pegawai</h1>
    <div class="my-2 flex sm:flex-row flex-col">
      <div class="block relative">
        <a class="text-white" href="/teacher/performance/create">
          <div class="mx-4 sm:mx-8 w-48 flex items-center p-4 bg-green-500 rounded-lg shadow-xs cursor-pointer hover:bg-green-400 hover:text-gray-100">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            <div>
              <p class=" text-xs font-bold ml-2 ">
                BUAT SKP
              </p>
            </div>
          </div>
        </a>
      </div>
    </div>
    <div class="mx-4 sm:mx-8 px-4 sm:px-8 py-4 overflow-x-auto ">
      <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
        <table class="min-w-full leading-normal">
          <thead>
            <tr>
              <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                No
              </th>
              <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Tahun SKP / Periode
              </th>
              <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Pangkat / Golongan
              </th>
              <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Status
              </th>
              <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Aksi
              </th>
            </tr>
          </thead>
          <tbody>
            @foreach($datas as $data)
            <tr>
              <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                <p class="text-gray-900 whitespace-no-wrap">
                  {{$loop->iteration}}
                </p>
              </td>
              <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                <p class="text-gray-900 whitespace-no-wrap">
                  {{$data->assessment_year}} - {{$data->period}}
                </p>
              </td>
              <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                <p class="text-gray-900 whitespace-no-wrap">
                  {{$data->rank->group}} / {{$data->rank->rank}}
                </p>
              </td>
              <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                <p class="text-gray-900 whitespace-no-wrap">
                  @if($data->is_ready == FALSE)
                  <span class="inline-block rounded-full text-gray-600 bg-gray-100 px-2 py-1 text-xs font-bold mr-3">Belum Dikunci</span>
                  @elseif($data->is_ready == TRUE && $data->is_direct_supervisor_approve == FALSE)
                  <span class="inline-block rounded-min text-white bg-indigo-500 px-2 py-1 text-xs font-bold mr-3">Menunggu Penilaian Kepala Sekolah</span>
                  @elseif($data->is_ready == TRUE && $data->is_direct_supervisor_approve == TRUE && $data->is_official_approve == FALSE)
                  <span class="inline-block rounded-min text-white bg-blue-500 px-2 py-1 text-xs font-bold mr-3">Menunggu Penilaian Kepala Bidang</span>
                  @elseif($data->is_ready == TRUE && $data->is_direct_supervisor_approve == TRUE && $data->is_official_approve == TRUE && $data->is_correction == FALSE)
                  <span class="inline-block rounded-full text-white bg-green-500 px-2 py-1 text-xs font-bold mr-3">Selesai</span>
                  @elseif($data->is_ready == TRUE && $data->is_direct_supervisor_approve == TRUE && $data->is_official_approve == TRUE && $data->is_correction == TRUE)
                  <span class="inline-block rounded-full text-white bg-yellow-500 px-2 py-1 text-xs font-bold mr-3">Pengajuan Keberatan</span>
                  @endif
                </p>
              </td>
              <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                <a href="/teacher/performance/show/{{$data->id}}" class="text-green-600 hover:text-green-400 ml-2">
                  <i class="material-icons-round text-base">visibility</i>
                </a>
                @if($data->is_ready == FALSE)
                <a href="/teacher/performance/destroy/{{$data->id}}" class="text-red-600 hover:text-red-400 ml-2">
                  <i class="material-icons-round text-base">delete_outline</i>
                </a>
                @else
                @endif
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
