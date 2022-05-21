@extends('layouts.principal')
@section('content')
<div class="min-h-screen bg-gray-200 py-3">
  <div class="px-5 mx-auto max-w-7x1">
    <a href="/principal/mapping">
      <button class="block text-green-500 rounded-sm font-bold py-4 px-6 mr-2 flex items-center hover:bg-green-500 hover:text-white">
        <svg class="h-5 w-5 mr-2 fill-current" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="-49 141 512 512" style="enable-background:new -49 141 512 512;" xml:space="preserve">
          <path id="XMLID_10_" d="M438,372H36.355l72.822-72.822c9.763-9.763,9.763-25.592,0-35.355c-9.763-9.764-25.593-9.762-35.355,0 l-115.5,115.5C-46.366,384.01-49,390.369-49,397s2.634,12.989,7.322,17.678l115.5,115.5c9.763,9.762,25.593,9.763,35.355,0 c9.763-9.763,9.763-25.592,0-35.355L36.355,422H438c13.808,0,25-11.193,25-25S451.808,372,438,372z"></path>
        </svg>
      </button>
    </a>
    <h1 class="mb-12 text-center text-4xl text-black font-bold">Data Pemetaan</h1>
    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
      <div class="w-full overflow-x-auto">
        <table class="w-full">
          <tbody class="bg-white">
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">Jenis Sekolah</td>
              <td class="px-4 py-3 text-ms border font-semibold">:</td>
              <td class="px-4 py-3 text-ms border">{{$data->school_type}}</td>
            </tr>
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">Tahun Pemetaan</td>
              <td class="px-4 py-3 text-ms border font-semibold">:</td>
              <td class="px-4 py-3 text-ms border">{{$data->study_year}}</td>
            </tr>
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">Nomor Statistik Sekolah (NSS)</td>
              <td class="px-4 py-3 text-ms border font-semibold">:</td>
              <td class="px-4 py-3 text-ms border">{{$data->school_statistic_number}}</td>
            </tr>
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">Nomor Pokok Sekolah Nasional (NPSN)</td>
              <td class="px-4 py-3 text-ms border font-semibold">:</td>
              <td class="px-4 py-3 text-ms border">{{$data->national_school_number}}</td>
            </tr>
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">Tanggal Akreditasi Terakhir</td>
              <td class="px-4 py-3 text-ms border font-semibold">:</td>
              <td class="px-4 py-3 text-ms border">{{$data->school_date}}</td>
            </tr>
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">Akreditasi Sekolah</td>
              <td class="px-4 py-3 text-ms border font-semibold">:</td>
              <td class="px-4 py-3 text-ms border">{{$data->school_accreditation}}</td>
            </tr>
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">Nama Sekolah</td>
              <td class="px-4 py-3 text-ms border font-semibold">:</td>
              <td class="px-4 py-3 text-ms border">{{$data->workUnit->name}}</td>
            </tr>
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">T.M.T Kepala Sekolah</td>
              <td class="px-4 py-3 text-ms border font-semibold">:</td>
              <td class="px-4 py-3 text-ms border">{{$data->principal_starting_from_date}}</td>
            </tr>
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">Total Rombel</td>
              <td class="px-4 py-3 text-ms border font-semibold">:</td>
              <td class="px-4 py-3 text-ms border">{{$data->total_study_group}} Rombel</td>
            </tr>
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">Total Peserta Didik</td>
              <td class="px-4 py-3 text-ms border font-semibold">:</td>
              <td class="px-4 py-3 text-ms border">{{$data->total_student}} Orang</td>
            </tr>
          </tbody>
        </table>
      </div>
      @if($data->is_finish == FALSE)
      <div class="w-48">
        <div class="my-2 flex sm:flex-row flex-col mt-10">
          <div class="block relative">
            <a class="text-white" href="/principal/mapping/subject/create/{{$id}}">
              <div class="flex items-center p-4 bg-green-500 rounded-lg shadow-xs cursor-pointer hover:bg-green-400 hover:text-gray-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <div>
                  <p class=" text-xs font-bold ml-2 ">
                    MATA PELAJARAN
                  </p>
                </div>
              </div>
            </a>
          </div>
        </div>
      </div>
      <div class="w-full overflow-x-auto">
        <table class="w-full">
          <thead>
            <tr class="text-md text-center font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
              <th class="px-4 py-3" colspan="4">Mata Pelajaran Tersedia</th>
            </tr>
            <tr class="text-md text-center font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
              <th class="px-4 py-3">No</th>
              <th class="px-4 py-3">Nama Mata Pelajaran</th>
              <th class="px-4 py-3">Total Jam Pelajaran</th>
              <th class="px-4 py-3">Aksi</th>
            </tr>
          </thead>
          <tbody class="bg-white">
            @foreach($subjects as $subject)
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">{{$loop->iteration}}</td>
              <td class="px-4 py-3 text-ms border">{{$subject->referenceSubject->name}}</td>
              <td class="px-4 py-3 text-ms border">{{$subject->total_hour}} Jam</td>
              <td class="px-4 py-3 text-ms border">
                <a href="{{ url ('/principal/mapping/subject/show', array( $id, $subject->id )) }}" class="text-green-600 hover:text-green-400 mr-2">
                  <i class="material-icons-outlined text-base">visibility</i>
                </a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
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
    <div class="flex items-center justify-center mt-10">
      <div class="w-full max-w-md mr-4">
        <form action="{{ route('principalmpfinish', $data->id)}}" method="POST" class="bg-white shadow-lg rounded px-12 pt-6 pb-8 mb-4 border-2 border-green-500">
          @csrf
          <div class="text-gray-800 text-2xl flex justify-center border-b-2 py-2">
            Selesaikan Pemetaan
          </div>
          <div class="text-gray-800 text-md text-center flex justify-center py-2 mb-4">
            Pastikan Pemetaan Benar-Benar Telah Selesai dan Semua Data Telah Sesuai, Setelah Mengunci Perubahan Sudah Tidak Dapat Dilakukan
          </div>
          <div class="flex items-center justify-center">
            <button class="shadow bg-green-600 hover:bg-green-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
              SELESAI
            </button>
          </div>
        </form>
      </div>
    </div>
    @else
    <div class="flex items-center justify-center mt-10">
      <div class="w-full max-w-md mr-4">
        <div class="bg-white shadow-lg rounded px-12 pt-6 pb-8 mb-4 border-2 border-green-500">
          <div class="text-gray-800 text-2xl flex justify-center border-b-2 py-2">
            Download PDF Pemetaan
          </div>
          <div class="text-gray-800 text-md text-center flex justify-center py-2 mb-4">
            Pemetaan Telah Selesai Dan Sudah Tidak Dapat Diubah Kembali, Silahkan Mendownload Hasil Pemetaan Dengan Mengklik Tombol Download Di Bawah
          </div>
          <div class="flex items-center justify-center">
            <button onclick="window.location='{{ route("principalmppdf",[$data->id]) }}'" class="shadow bg-green-600 hover:bg-green-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
              Download
            </button>
          </div>
        </div>
      </div>
    </div>
    @endif
  </div>
</div>
</div>
@endsection
