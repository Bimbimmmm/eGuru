@extends('layouts.teacher')
@section('content')
<div class="min-h-screen bg-gray-200 py-3">
  <a href="/teacher/performance">
    <button class="block text-green-500 rounded-sm font-bold py-4 px-6 mr-2 flex items-center hover:bg-green-500 hover:text-white">
      <svg class="h-5 w-5 mr-2 fill-current" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="-49 141 512 512" style="enable-background:new -49 141 512 512;" xml:space="preserve">
        <path id="XMLID_10_" d="M438,372H36.355l72.822-72.822c9.763-9.763,9.763-25.592,0-35.355c-9.763-9.764-25.593-9.762-35.355,0 l-115.5,115.5C-46.366,384.01-49,390.369-49,397s2.634,12.989,7.322,17.678l115.5,115.5c9.763,9.762,25.593,9.763,35.355,0 c9.763-9.763,9.763-25.592,0-35.355L36.355,422H438c13.808,0,25-11.193,25-25S451.808,372,438,372z"></path>
      </svg>
    </button>
  </a>
  <div class="px-5 mx-auto max-w-7x1">
    <h1 class="mb-12 text-center text-4xl text-black font-bold">Sasaran Kinerja Pegawai</h1>
    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
      <div class="w-full overflow-x-auto">
        <table class="w-full">
          <tbody class="bg-white">
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">No</td>
              <td class="px-4 py-3 text-ms border font-semibold" colspan="2">I. Pejabat Penilai</td>
              <td class="px-4 py-3 text-ms border font-semibold">No</td>
              <td class="px-4 py-3 text-ms border font-semibold" colspan="2">II. Pegawai Negeri Sipil Yang Dinilai</td>
            </tr>
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">1</td>
              <td class="px-4 py-3 text-ms border font-semibold">Nama</td>
              <td class="px-4 py-3 text-ms border">{{$data->positionMapping->principal->personalData->name}}</td>
              <td class="px-4 py-3 text-ms border font-semibold">1</td>
              <td class="px-4 py-3 text-ms border font-semibold">Nama</td>
              <td class="px-4 py-3 text-ms border">{{$data->user->personalData->name}}</td>
            </tr>
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">2</td>
              <td class="px-4 py-3 text-ms border font-semibold">NIP</td>
              <td class="px-4 py-3 text-ms border">{{$data->positionMapping->principal->personalData->registration_number}}</td>
              <td class="px-4 py-3 text-ms border font-semibold">2</td>
              <td class="px-4 py-3 text-ms border font-semibold">NIP</td>
              <td class="px-4 py-3 text-ms border">{{$data->user->personalData->registration_number}}</td>
            </tr>
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">3</td>
              <td class="px-4 py-3 text-ms border font-semibold">Pangkat / Gol Ruang</td>
              <td class="px-4 py-3 text-ms border">{{$data->positionMapping->principal->personalData->rank->rank}} / {{$data->positionMapping->principal->personalData->rank->group}}</td>
              <td class="px-4 py-3 text-ms border font-semibold">3</td>
              <td class="px-4 py-3 text-ms border font-semibold">Pangkat / Gol Ruang</td>
              <td class="px-4 py-3 text-ms border">{{$data->user->personalData->rank->rank}} / {{$data->user->personalData->rank->group}}</td>
            </tr>
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">4</td>
              <td class="px-4 py-3 text-ms border font-semibold">Jabatan</td>
              <td class="px-4 py-3 text-ms border">{{$data->positionMapping->principal->personalData->position->name}}</td>
              <td class="px-4 py-3 text-ms border font-semibold">4</td>
              <td class="px-4 py-3 text-ms border font-semibold">Jabatan</td>
              <td class="px-4 py-3 text-ms border">{{$data->user->personalData->position->name}}</td>
            </tr>
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">5</td>
              <td class="px-4 py-3 text-ms border font-semibold">Unit Kerja</td>
              <td class="px-4 py-3 text-ms border">{{$data->positionMapping->principal->personalData->workUnit->name}}</td>
              <td class="px-4 py-3 text-ms border font-semibold">5</td>
              <td class="px-4 py-3 text-ms border font-semibold">Unit Kerja</td>
              <td class="px-4 py-3 text-ms border">{{$data->user->personalData->workUnit->name}}</td>
            </tr>
            @if($data->is_official_approve == TRUE && $data->is_correction == FALSE)
            <tr class="text-gray-700 text-center">
              <td colspan="3" class="px-4 py-3 text-ms border font-semibold">
                File Perencanaan
              </td>
              <td colspan="3" class="px-4 py-3 text-ms border font-semibold">
                <a href="/teacher/performance/show/planning/{{$data->id}}">
                  <span class="inline-block rounded-min text-white bg-green-500 px-2 py-1 text-xs font-bold mr-3">Lihat</span>
                </a>
              </td>
            </tr>
            <tr class="text-gray-700 text-center">
              <td colspan="3" class="px-4 py-3 text-ms border font-semibold">
                File Penilaian
              </td>
              <td colspan="3" class="px-4 py-3 text-ms border font-semibold">
                <a href="/teacher/performance/show/realization/{{$data->id}}">
                  <span class="inline-block rounded-min text-white bg-green-500 px-2 py-1 text-xs font-bold mr-3">Lihat</span>
                </a>
              </td>
            </tr>
            <tr class="text-gray-700 text-center">
              <td colspan="3" class="px-4 py-3 text-ms border font-semibold">
                File Daftar Penilaian Pelaksanaan Pekerjaan (DP3)
              </td>
              <td colspan="3" class="px-4 py-3 text-ms border font-semibold">
                <a href="/teacher/performance/show/dp3/{{$data->id}}">
                  <span class="inline-block rounded-min text-white bg-green-500 px-2 py-1 text-xs font-bold mr-3">Lihat</span>
                </a>
              </td>
            </tr>
            @else
            @endif
          </tbody>
        </table>
      </div>
      <div class="w-full overflow-x-auto py-5">
        @if($data->is_ready == FALSE)
        <div class="my-2 flex flex-row">
          <div class="block relative">
            <a class="text-white" href="/teacher/performance/activity/create/pbt/{{$data->id}}">
              <div class="mx-4 sm:mx-8 w-auto flex items-center p-4 bg-green-500 rounded-lg shadow-xs cursor-pointer hover:bg-green-400 hover:text-gray-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <div>
                  <p class=" text-xs font-bold ml-2 ">
                    KEGIATAN PEMBELAJARAN / BIMBINGAN / TUGAS TERTENTU
                  </p>
                </div>
              </div>
            </a>
          </div>
          @if($count > 1)
          <div class="block relative">
            <a class="text-white" href="/teacher/performance/activity/create/pkb/{{$data->id}}">
              <div class="mx-4 sm:mx-8 w-auto flex items-center p-4 bg-green-500 rounded-lg shadow-xs cursor-pointer hover:bg-green-400 hover:text-gray-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <div>
                  <p class=" text-xs font-bold ml-2 ">
                    KEGIATAN PENGEMBANGAN KEPROFESIAN BERKELANJUTAN
                  </p>
                </div>
              </div>
            </a>
          </div>
          <div class="block relative">
            <a class="text-white" href="/teacher/performance/activity/create/up/{{$data->id}}">
              <div class="mx-4 sm:mx-8 w-auto  flex items-center p-4 bg-green-500 rounded-lg shadow-xs cursor-pointer hover:bg-green-400 hover:text-gray-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <div>
                  <p class=" text-xs font-bold ml-2 ">
                    KEGIATAN UNSUR PENUNJANG
                  </p>
                </div>
              </div>
            </a>
          </div>
          @endif
        </div>
        @else
        @endif
        <table class="w-full">
          <thead>
            <tr>
              <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                No
              </th>
              <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                III. Kegiatan Tugas Jabatan
              </th>
              <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                AK
              </th>
              <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Target Kuantitas / Output
              </th>
              <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Target Kualitas / Mutu
              </th>
              <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Target Waktu
              </th>
              <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Target Biaya
              </th>
              <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                File
              </th>
              @if($data->is_ready == FALSE)
              <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Aksi
              </th>
              @else
              @endif
            </tr>
          </thead>
          <tbody class="bg-white">
            @foreach($activities as $activity)
            <tr>
              <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                <p class="text-gray-900 whitespace-no-wrap">
                  {{$loop->iteration}}
                </p>
              </td>
              <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                <p class="text-gray-900 whitespace-no-wrap">
                  {{$activity->refActivityCreditScore->grain_item}}
                </p>
              </td>
              <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                <p class="text-gray-900 whitespace-no-wrap">
                  {{$activity->target_credit_score}}
                </p>
              </td>
              <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                <p class="text-gray-900 whitespace-no-wrap">
                  {{$activity->target_qty}} {{$activity->target_output}}
                </p>
              </td>
              <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                <p class="text-gray-900 whitespace-no-wrap">
                  {{$activity->target_quality}}
                </p>
              </td>
              <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                <p class="text-gray-900 whitespace-no-wrap">
                  {{$activity->target_time}} {{$activity->target_time_unit}}
                </p>
              </td>
              <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                <p class="text-gray-900 whitespace-no-wrap">
                  {{$activity->target_cost}}
                </p>
              </td>
              <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                <p class="text-gray-900 whitespace-no-wrap">
                  @if($activity->file == NULL)
                  <a href="/teacher/performance/activity/show/{{$activity->id}}/{{$data->id}}" class="text-green-600 hover:text-green-400 ml-2">
                    <i class="material-icons-round text-base">visibility</i>
                  </a>
                  @else
                  {{$activity->file}}
                  @endif
                </p>
              </td>
              @if($data->is_ready == FALSE)
              <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                <a href="/teacher/performance/activity/delete/{{$activity->id}}" class="text-red-600 hover:text-red-400 ml-2">
                  <i class="material-icons-round text-base">delete_outline</i>
                </a>
              </td>
              @else
              @endif
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      @if($data->is_ready == FALSE)
      <div class="flex items-center justify-center mt-10">
        <div class="w-full max-w-md mr-4">
          <form action="{{ route('teacherptlock', $data->id)}}" method="POST" class="bg-white shadow-lg rounded px-12 pt-6 pb-8 mb-4 border-2 border-red-500">
            @csrf
            <div class="text-gray-800 text-2xl flex justify-center border-b-2 py-2 mb-4">
              KUNCI SKP
            </div>
            <div class="container" id="alertbox">
              <div class="container bg-yellow-500 flex items-center text-white text-sm font-bold px-4 py-3 relative"
              role="alert">
              <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path
                d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z" />
              </svg>
              <p>Jika SKP Telah Terkunci, Perubahan Sudah Tidak Dapat Dilakukan</p>
            </div>
          </div>
          <div class="flex items-center justify-center mt-6">
            <button class="shadow bg-red-600 hover:bg-red-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
              Kunci
            </button>
          </div>
        </form>
      </div>
    </div>
    @else
    @endif
  </div>
</div>
</div>
</div>
@endsection
