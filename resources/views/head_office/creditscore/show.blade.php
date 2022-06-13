@extends('layouts.headoffice')
@section('content')
<div class="min-h-screen bg-gray-200 py-3">
  <a href="/officehead/creditscore">
    <button class="block text-green-500 rounded-sm font-bold py-4 px-6 mr-2 flex items-center hover:bg-green-500 hover:text-white">
      <svg class="h-5 w-5 mr-2 fill-current" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="-49 141 512 512" style="enable-background:new -49 141 512 512;" xml:space="preserve">
        <path id="XMLID_10_" d="M438,372H36.355l72.822-72.822c9.763-9.763,9.763-25.592,0-35.355c-9.763-9.764-25.593-9.762-35.355,0 l-115.5,115.5C-46.366,384.01-49,390.369-49,397s2.634,12.989,7.322,17.678l115.5,115.5c9.763,9.762,25.593,9.763,35.355,0 c9.763-9.763,9.763-25.592,0-35.355L36.355,422H438c13.808,0,25-11.193,25-25S451.808,372,438,372z"></path>
      </svg>
    </button>
  </a>
  <div class="px-5 mx-auto max-w-7x1">
    <h1 class="mb-12 text-center text-4xl text-black font-bold">Detail Penilaian Angka Kredit</h1>
    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
      <div class="w-full overflow-x-auto">
        <table class="w-full">
          <tbody class="bg-white">
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">Nama</td>
              <td class="px-4 py-3 text-ms border">{{$assesment->user->personalData->name}}</td>
            </tr>
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">Nomor Induk Pegawai</td>
              <td class="px-4 py-3 text-ms border">{{$assesment->user->personalData->registration_number}}</td>
            </tr>
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">Nomor Induk Pegawai</td>
              <td class="px-4 py-3 text-ms border">{{$assesment->user->personalData->workUnit->name}}</td>
            </tr>
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">SKP Tahun Berjalan</td>
              <td class="px-4 py-3 text-ms border">{{$assesment->newPerformanceTarget->assessment_year}} - {{$assesment->newPerformanceTarget->period}}</td>
            </tr>
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">Masa Kerja Lama - Masa Kerja Baru</td>
              <td class="px-4 py-3 text-ms border">{{$assesment->old_work_year}} - {{$assesment->new_work_year}}</td>
            </tr>
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">Tingkat Pendidikan Yang Dinilai</td>
              <td class="px-4 py-3 text-ms border">{{$assesment->refEduCreditScore->name}}</td>
            </tr>
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">Jumlah Total Nilai PAK Tahun Ini</td>
              <td class="px-4 py-3 text-ms border"><b>{{$assesment->total_assessment_credit_score}}</b></td>
            </tr>
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">File PAK Tahun Lalu</td>
              <td class="px-4 py-3 text-ms border">
                <a class="text-blue-500 underline" href="{{ asset('storage/creditscore/' . $assesment->file) }}">
                  {{$assesment->file}}
                </a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
</div>
</div>
@endsection
