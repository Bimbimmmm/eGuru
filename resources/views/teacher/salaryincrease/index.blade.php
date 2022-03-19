@extends('layouts.teacher')
@section('content')
<div class="min-h-screen bg-gray-100 py-14">
  <div class="px-5 mx-auto max-w-7x1">
    <h1 class="mb-12 text-center text-4xl text-gray-500 font-bold">Kenaikan Gaji Berkala</h1>
    <div class="w-48">
      <div class="my-2 flex sm:flex-row flex-col">
        <div class="block relative">
          <a class="text-white" href="/teacher/salaryincrease/create">
            <div class="flex items-center p-4 bg-green-500 rounded-lg shadow-xs cursor-pointer hover:bg-green-400 hover:text-gray-100">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
              </svg>
              <div>
                <p class=" text-xs font-bold ml-2">
                  AJUKAN KENAIKAN GAJI BERKALA
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
            <th class="px-4 py-3">Tahun Pengajuan</th>
            <th class="px-4 py-3">Tipe Kenaikan Gaji Berkala</th>
            <th class="px-4 py-3">Status</th>
            <th class="px-4 py-3">Aksi</th>
          </tr>
        </thead>
        <tbody class="bg-white">
          @foreach($datas as $data)
          <tr class="text-gray-700 text-center">
            <td class="px-4 py-3 text-ms border font-semibold">{{$loop->iteration}}</td>
            <td class="px-4 py-3 text-ms border">{{$data->year}}</td>
            <td class="px-4 py-3 text-ms border">{{$data->type}}</td>
            @if($data->is_locked == FALSE)
            <td class="px-4 py-3 text-sm border">
              <span class="inline-block rounded-full text-white bg-yellow-500 px-2 py-1 text-xs font-bold mr-3">Belum Dikunci</span>
            </td>
            @elseif($data->is_locked == TRUE && $data->is_finish == FALSE && $data->is_rejected == FALSE)
            <td class="px-4 py-3 text-sm border">
              <span class="inline-block rounded-full text-white bg-indigo-500 px-2 py-1 text-xs font-bold mr-3">Menunggu Persetujuan</span>
            </td>
            @elseif($data->is_finish == TRUE && $data->is_rejected == FALSE)
            <td class="px-4 py-3 text-sm border">
              <span class="inline-block rounded-full text-white bg-green-500 px-2 py-1 text-xs font-bold mr-3">Sudah Dinilai</span>
              <a href="{{ url ('/teacher/salaryincrease/pdf', array("$data->id")) }}">
                <span class="inline-block rounded-full text-white bg-green-500 px-2 py-1 text-xs font-bold mr-3">Lihat Hasil</span>
              </a>
            </td>
            @endif
            <td class="px-4 py-3 text-sm border">
              <a href="{{ url ('/teacher/salaryincrease/show', array("$data->id")) }}" class="text-green-600 hover:text-green-400 mr-2">
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
