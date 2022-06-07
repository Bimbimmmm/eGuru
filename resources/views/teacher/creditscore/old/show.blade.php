@extends('layouts.teacher')
@section('content')
<div class="min-h-screen bg-gray-200 py-3">
  <a href="/teacher/creditscore">
    <button class="block text-green-500 rounded-sm font-bold py-4 px-6 mr-2 flex items-center hover:bg-green-500 hover:text-white">
      <svg class="h-5 w-5 mr-2 fill-current" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="-49 141 512 512" style="enable-background:new -49 141 512 512;" xml:space="preserve">
        <path id="XMLID_10_" d="M438,372H36.355l72.822-72.822c9.763-9.763,9.763-25.592,0-35.355c-9.763-9.764-25.593-9.762-35.355,0 l-115.5,115.5C-46.366,384.01-49,390.369-49,397s2.634,12.989,7.322,17.678l115.5,115.5c9.763,9.762,25.593,9.763,35.355,0 c9.763-9.763,9.763-25.592,0-35.355L36.355,422H438c13.808,0,25-11.193,25-25S451.808,372,438,372z"></path>
      </svg>
    </button>
  </a>
  <div class="px-5 mx-auto max-w-7x1">
    <h1 class="mb-12 text-center text-4xl text-black font-bold">Penilaian Angka Kredit</h1>
    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
      <div class="w-full overflow-x-auto">
        <table class="w-full">
          <tbody class="bg-white">
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">SKP Tahun Berjalan</td>
              <td class="px-4 py-3 text-ms border">{{$assesment->performanceTarget->assessment_year}} - {{$assesment->performanceTarget->period}}</td>
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
              <td class="px-4 py-3 text-ms border font-semibold">Angka Kredit PAK Tahun Lalu</td>
              <td class="px-4 py-3 text-ms border">{{$assesment->last_assessment_credit_score}}</td>
            </tr>
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">File PAK Tahun Lalu</td>
              <td class="px-4 py-3 text-ms border">
                <a href="{{ asset('storage/creditscore/' . $assesment->file) }}">
                  {{$assesment->file}}
                </a>
              </td>
            </tr>
            @if($assesment->is_official_approve == TRUE)
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">File PAK {{$assesment->performanceTarget->assessment_year}}</td>
              <td class="px-4 py-3 text-ms border">
                <a href="/teacher/creditscore/pdf/{{$assesment->id}}">
                    <span class="inline-block rounded-min text-white bg-green-500 px-2 py-1 text-xs font-bold mr-3">Download</span>
                </a>
              </td>
            </tr>
            @endif
          </tbody>
        </table>
      </div>
    </div>
    <div class="mx-4 sm:mx-8 px-4 sm:px-8 py-4 overflow-x-auto ">
      @if($assesment->is_ready == FALSE)
      <div class="my-2 flex sm:flex-row flex-col">
        <div class="block relative ">
          <a class="text-white" href="/teacher/creditscore/create/oldactivity/{{$assesment->id}}">
            <div class="sm:mx-8 w-48 flex items-center p-4 bg-green-500 rounded-lg shadow-xs cursor-pointer hover:bg-green-400 hover:text-gray-100">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
              </svg>
              <div>
                <p class=" text-xs font-bold ml-2 ">
                  KEGIATAN LAMA
                </p>
              </div>
            </div>
          </a>
        </div>
      </div>
      @endif
      <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
        <table class="min-w-full leading-normal">
          <thead>
            <tr>
              <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                No
              </th>
              <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Nama
              </th>
              <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Angka Kredit Lama
              </th>
              <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Angka Kredit Baru
              </th>
              <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Total Angka Kredit
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
                  {{$data->refAsCSActivity->activity_item}}
                </p>
              </td>
              <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                <p class="text-gray-900 whitespace-no-wrap">
                  {{$data->old_credit_score}}
                </p>
              </td>
              <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                <p class="text-gray-900 whitespace-no-wrap">
                  {{$data->new_user_credit_score}}
                </p>
              </td>
              <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                <p class="text-gray-900 whitespace-no-wrap">
                  {{$data->total_user_credit_score}}
                </p>
              </td>
              <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                <p class="text-gray-900 whitespace-no-wrap">
                  @if($data->total_user_credit_score == NULL)
                  <span class="inline-block rounded-full text-gray-600 bg-gray-100 px-2 py-1 text-xs font-bold mr-3">Belum Diisi</span>
                  @else
                  <span class="inline-block rounded-full text-white bg-green-500 px-2 py-1 text-xs font-bold mr-3">Sudah Diisi</span>
                  @endif
                </p>
              </td>
              <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                <a href="/teacher/creditscore/edit/{{$data->id}}/{{$assesment->id}}" class="text-green-600 hover:text-green-400 ml-2">
                  <i class="material-icons-round text-base">visibility</i>
                </a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      @if($assesment->is_ready == FALSE)
      <div class="flex items-center justify-center mt-10">
        <div class="w-full max-w-md mr-4">
          <form action="{{ route('teachercslock', array("$assesment->id"))}}" method="POST" class="bg-white shadow-lg rounded px-12 pt-6 pb-8 mb-4 border-2 border-red-500">
            @csrf
            <div class="text-gray-800 text-2xl flex justify-center border-b-2 py-2 mb-4">
              Kunci Pengajuan
            </div>
            <div class="mb-6 text-center">
              <label class="block text-gray-700 text-sm font-normal mb-2" for="password">
                Jika Pengajuan Sudah Dikunci, Perubahan Sudah Tidak Dapat Dilakukan
              </label>
            </div>
            <div class="flex items-center justify-center">
              <button class="shadow bg-red-600 hover:bg-red-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
                Kunci
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
