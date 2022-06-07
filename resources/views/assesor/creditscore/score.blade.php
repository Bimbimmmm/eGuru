@extends('layouts.assesor')
@section('content')
<div class="min-h-screen bg-gray-200 py-3">
  <a href="/assesor/creditscore/show/{{$data2->id}}">
    <button class="block text-green-500 rounded-sm font-bold py-4 px-6 mr-2 flex items-center hover:bg-green-500 hover:text-white">
      <svg class="h-5 w-5 mr-2 fill-current" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="-49 141 512 512" style="enable-background:new -49 141 512 512;" xml:space="preserve">
        <path id="XMLID_10_" d="M438,372H36.355l72.822-72.822c9.763-9.763,9.763-25.592,0-35.355c-9.763-9.764-25.593-9.762-35.355,0 l-115.5,115.5C-46.366,384.01-49,390.369-49,397s2.634,12.989,7.322,17.678l115.5,115.5c9.763,9.762,25.593,9.763,35.355,0 c9.763-9.763,9.763-25.592,0-35.355L36.355,422H438c13.808,0,25-11.193,25-25S451.808,372,438,372z"></path>
      </svg>
    </button>
  </a>
  <div class="px-5 mx-auto max-w-7x1">
    <h1 class="mb-12 text-center text-4xl text-black font-bold">Rincian Kegiatan</h1>
    <div class="mx-4 sm:mx-8 px-4 sm:px-8 py-4 overflow-x-auto ">
      <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
        <table class="min-w-full leading-normal">
          <thead>
            <tr>
              <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Nama
              </th>
              <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Angka Kredit
              </th>
              <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Jumlah
              </th>
              <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                File
              </th>
              <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Aksi
              </th>
            </tr>
          </thead>
          <tbody>
            @foreach($filedatas as $filedata)
            @if($filedata->refPerformanceElement->code >= $code_low && $filedata->refPerformanceElement->code < $code_up)
            <tr>
              <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                <p class="text-gray-900 whitespace-no-wrap">
                  {{$filedata->refPerformanceElement->performance_plan}} -> {{$filedata->refPerformanceElement->activity_item}}
                </p>
              </td>
              <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                <p class="text-gray-900 whitespace-no-wrap">
                  {{$filedata->realization_credit_score}}
                </p>
              </td>
              <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                <p class="text-gray-900 whitespace-no-wrap">
                  {{$filedata->realization_qty}}
                </p>
              </td>
              <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                <a href="{{ asset('storage/performancetarget/activity/' . $filedata->file) }}"class="text-blue-500 underline whitespace-no-wrap">
                  {{$filedata->file}}
                </a>
              </td>
              <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                <a href="/assesor/creditscore/reject/{{$filedata->id}}/{{$data->id}}/{{$data2->id}}" class="text-green-600 hover:text-green-400 ml-2">
                  <i class="material-icons-round text-base">visibility</i>
                </a>
              </td>
            </tr>
            @endif
            @endforeach
          </tbody>
        </table>
      </div>
      @if($data->total_evaluator_credit_score == NULL)
      <div class="w-full mt-8 overflow-hidden rounded-lg shadow-lg">
        <div class="w-full overflow-x-auto">
          <table class="w-full">
            <tbody class="bg-white">
              <tr class="text-gray-700 text-center">
                <td class="px-4 py-3 text-ms border font-semibold">Nama Kegiatan</td>
                <td class="px-4 py-3 text-ms border">{{$data->refAsCSActivity->activity_item}}</td>
              </tr>
              <tr class="text-gray-700 text-center">
                <td class="px-4 py-3 text-ms border font-semibold">Nilai Lama</td>
                <td class="px-4 py-3 text-ms border">{{$data->old_credit_score}}</td>
              </tr>
              <tr class="text-gray-700 text-center">
                <td class="px-4 py-3 text-ms border font-semibold">Nilai Pengusul</td>
                <td class="px-4 py-3 text-ms border">{{$data->new_user_credit_score}}</td>
              </tr>
              <tr class="text-gray-700 text-center">
                <td class="px-4 py-3 text-ms border font-semibold">Nilai Usulan Ditolak</td>
                <td class="px-4 py-3 text-ms border">{{$reject}}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="flex items-center justify-center mt-2">
        <div class="w-full max-w-md mr-4">
          <form action="{{ route('assesorcrscoring', array("$id", "$idc"))}}" method="POST" class="bg-white shadow-lg rounded px-12 pt-6 pb-8 mb-4 border-2">
            @csrf
            <div class="text-gray-800 text-2xl flex justify-center border-b-2 py-2 mb-4">
              Form Penilaian
            </div>
            <div class="mb-6 text-center">
              <label class="block text-gray-700 text-sm text-center font-normal mb-2" for="password">
                Jika Pengajuan Sudah Dikunci, Perubahan Sudah Tidak Dapat Dilakukan
              </label>
            </div>
            <div class="mb-6">
              <label class="block text-gray-700 text-sm text-center font-normal mb-2" for="password">
                Nilai Penilai
              </label>
              <input name="new_evaluator_credit_score" type="number" step=".0001" value="{{$total_evaluator_credit_score}}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"/>
            </div>
            <div class="flex items-center justify-center">
              <button class="shadow bg-green-600 hover:bg-green-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
                Nilai
              </button>
            </div>
          </form>
        </div>
      </div>
      @endif
    </div>
  </div>
</div>
</div>
@endsection
