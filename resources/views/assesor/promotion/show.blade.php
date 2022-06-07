@extends('layouts.assesor')
@section('content')
<div class="min-h-screen bg-gray-200 py-3">
  <a href="/assesor/promotion">
    <button class="block text-green-500 rounded-sm font-bold py-4 px-6 mr-2 flex items-center hover:bg-green-500 hover:text-white">
      <svg class="h-5 w-5 mr-2 fill-current" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="-49 141 512 512" style="enable-background:new -49 141 512 512;" xml:space="preserve">
        <path id="XMLID_10_" d="M438,372H36.355l72.822-72.822c9.763-9.763,9.763-25.592,0-35.355c-9.763-9.764-25.593-9.762-35.355,0 l-115.5,115.5C-46.366,384.01-49,390.369-49,397s2.634,12.989,7.322,17.678l115.5,115.5c9.763,9.762,25.593,9.763,35.355,0 c9.763-9.763,9.763-25.592,0-35.355L36.355,422H438c13.808,0,25-11.193,25-25S451.808,372,438,372z"></path>
      </svg>
    </button>
  </a>
  <div class="px-5 mx-auto max-w-7x1">
    <h1 class="mb-12 text-center text-4xl text-black font-bold">Penilaian Kenaikan Pangkat</h1>
    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
      <div class="w-full overflow-x-auto">
        <table class="w-full">
          <tbody class="bg-white">
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">Nama</td>
              <td class="px-4 py-3 text-ms border">{{$data->user->personalData->name}}</td>
            </tr>
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">Nomor Induk Pegawai</td>
              <td class="px-4 py-3 text-ms border">{{$data->user->personalData->registration_number}}</td>
            </tr>
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">Unit Kerja</td>
              <td class="px-4 py-3 text-ms border">{{$data->user->personalData->workUnit->name}}</td>
            </tr>
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">Jenis Pengajuan</td>
              <td class="px-4 py-3 text-ms border">{{$data->refPromotionCreditScore->current_rank}} ke {{$data->refPromotionCreditScore->promotion_rank}}</td>
            </tr>
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">Tahun dan Periode Pengajuan</td>
              <td class="px-4 py-3 text-ms border">{{$data->newAssementCredit->newPerformanceTarget->assessment_year}} - {{$data->promotion_period}}</td>
            </tr>
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">Jumlah Angka Kredit PAK KENPA Terakhir</td>
              <td class="px-4 py-3 text-ms border">{{$data->last_promotion_credit_score}}</td>
            </tr>
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">Masa Kerja Lama</td>
              <td class="px-4 py-3 text-ms border">{{$data->old_work_year}}</td>
            </tr>
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">File PAK KENPA Terakhir</td>
              <td class="px-4 py-3 text-ms border">
                <a class="text-blue-500 underline" href="{{ asset('storage/promotion/' . $data->file) }}">
                  {{$data->file}}
                </a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
      <table class="min-w-full leading-normal">
        <thead>
          <tr>
            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
              No
            </th>
            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
              Nama File
            </th>
            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
              File
            </th>
          </tr>
        </thead>
        <tbody>
          @foreach($files as $file)
          <tr>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
              <p class="text-gray-900 whitespace-no-wrap">
                {{$loop->iteration}}
              </p>
            </td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
              <p class="text-gray-900 whitespace-no-wrap">
                {{$file->refPromotionFile->name}}
              </p>
            </td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
              <a href="{{ asset('storage/promotion/completeness/' . $file->file) }}" class="text-blue-500 underline whitespace-no-wrap">
                {{$file->file}}
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="mx-4 sm:mx-8 px-4 sm:px-8 py-4 overflow-x-auto ">
      <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
        <table class="min-w-full leading-normal">
          <thead>
            <tr>
              <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                No
              </th>
              <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Nama Kredit
              </th>
              <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Nilai Lama
              </th>
              <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Nilai Yang Diperhitungkan
              </th>
              <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Nilai Yang Didapatkan
              </th>
            </tr>
          </thead>
          <tbody>
            @foreach($scores as $score)
            <tr>
              <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                <p class="text-gray-900 whitespace-no-wrap">
                  {{$loop->iteration}}
                </p>
              </td>
              <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                <p class="text-gray-900 whitespace-no-wrap">
                  {{$score->refAssesmentCreditScoreAct->activity_item}}
                </p>
              </td>
              <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                <p class="text-gray-900 whitespace-no-wrap">
                  {{$score->old_credit_score}}
                </p>
              </td>
              <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                <p class="text-gray-900 whitespace-no-wrap">
                  {{$score->new_credit_score}}
                </p>
              </td>
              <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                <p class="text-gray-900 whitespace-no-wrap">
                  {{$score->get_credit_score}}
                </p>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      @if($data->is_rejected == FALSE && $is_promote < 4)
      <div class="flex items-center justify-center mt-10">
        <div class="w-full max-w-md mr-4">
          <form action="{{ route('assesorprreject', array("$data->id" , "$reason"))}}" method="POST" class="bg-white shadow-lg rounded px-12 pt-6 pb-8 mb-4 border-2 border-red-500">
            @csrf
            <div class="text-gray-800 text-2xl flex justify-center border-b-2 py-2 mb-4">
              Tidak Memenuhi Syarat
            </div>
            <div class="mb-6 text-center">
              <label class="block text-gray-700 text-sm font-normal mb-2" for="password">
                Pengajuan Kenaikan Pangkat Ditolak Karena {{$reason}}
              </label>
            </div>
            <div class="flex items-center justify-center">
              <button class="shadow bg-red-600 hover:bg-red-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
                Tolak
              </button>
            </div>
          </form>
        </div>
      </div>
      @elseif($data->is_rejected == FALSE && $is_promote == 4)
      <div class="flex items-center justify-center mt-10">
        <div class="w-full max-w-md mr-4">
          <form action="{{ route('assesorpracc', array("$data->id"))}}" method="POST" class="bg-white shadow-lg rounded px-12 pt-6 pb-8 mb-4 border-2 border-green-500">
            @csrf
            <div class="text-gray-800 text-2xl flex justify-center border-b-2 py-2 mb-4">
              Memenuhi Syarat
            </div>
            @if(session('errors'))
            @foreach ($errors->all() as $error)
            <div class="bg-red-200 px-6 py-4 mx-2 my-4 rounded-md text-lg flex items-center">
              <svg viewBox="0 0 24 24" class="text-red-600 w-5 h-5 sm:w-5 sm:h-5 mr-3">
                <path fill="currentColor"  d="M11.983,0a12.206,12.206,0,0,0-8.51,3.653A11.8,11.8,0,0,0,0,12.207,11.779,11.779,0,0,0,11.8,24h.214A12.111,12.111,0,0,0,24,11.791h0A11.766,11.766,0,0,0,11.983,0ZM10.5,16.542a1.476,1.476,0,0,1,1.449-1.53h.027a1.527,1.527,0,0,1,1.523,1.47,1.475,1.475,0,0,1-1.449,1.53h-.027A1.529,1.529,0,0,1,10.5,16.542ZM11,12.5v-6a1,1,0,0,1,2,0v6a1,1,0,1,1-2,0Z"></path>
              </svg>
              <span class="text-red-800">{{ $error }}</span>
            </div>
            @endforeach
            @endif
            <div class="mb-6 text-center">
              <label class="block text-gray-700 text-sm font-normal mb-2" for="password">
                Pengajuan Kenaikan Pangkat Memenuhi Syarat
              </label>
            </div>
            <div class="mb-6">
              <label class="block text-gray-700 text-sm font-normal mb-2" for="password">
                Masa Kerja Baru
              </label>
              <input name="new_work_year" id="new_work_year" placeholder="XX Tahun XX Bulan" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text"></input>
            </div>
            <div class="flex items-center justify-center">
              <button class="shadow bg-green-600 hover:bg-green-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
                Terima
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
