@extends('layouts.divisionhead')
@section('content')
<div class="min-h-screen bg-gray-200 py-3">
  <a href="/divisionhead/performance">
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
              <td class="px-4 py-3 text-ms border font-semibold" colspan="2">I. Atasan Pejabat Penilai</td>
              <td class="px-4 py-3 text-ms border font-semibold">No</td>
              <td class="px-4 py-3 text-ms border font-semibold" colspan="2">II. Pegawai Negeri Sipil Yang Dinilai</td>
            </tr>
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">1</td>
              <td class="px-4 py-3 text-ms border font-semibold">Nama</td>
              <td class="px-4 py-3 text-ms border">{{$data->positionMapping->supervisor->personalData->name}}</td>
              <td class="px-4 py-3 text-ms border font-semibold">1</td>
              <td class="px-4 py-3 text-ms border font-semibold">Nama</td>
              <td class="px-4 py-3 text-ms border">{{$data->user->personalData->name}}</td>
            </tr>
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">2</td>
              <td class="px-4 py-3 text-ms border font-semibold">NIP</td>
              <td class="px-4 py-3 text-ms border">{{$data->positionMapping->supervisor->personalData->registration_number}}</td>
              <td class="px-4 py-3 text-ms border font-semibold">2</td>
              <td class="px-4 py-3 text-ms border font-semibold">NIP</td>
              <td class="px-4 py-3 text-ms border">{{$data->user->personalData->registration_number}}</td>
            </tr>
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">3</td>
              <td class="px-4 py-3 text-ms border font-semibold">Pangkat / Gol Ruang</td>
              <td class="px-4 py-3 text-ms border">{{$data->positionMapping->supervisor->personalData->rank->rank}} / {{$data->positionMapping->supervisor->personalData->rank->group}}</td>
              <td class="px-4 py-3 text-ms border font-semibold">3</td>
              <td class="px-4 py-3 text-ms border font-semibold">Pangkat / Gol Ruang</td>
              <td class="px-4 py-3 text-ms border">{{$data->user->personalData->rank->rank}} / {{$data->user->personalData->rank->group}}</td>
            </tr>
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">4</td>
              <td class="px-4 py-3 text-ms border font-semibold">Jabatan</td>
              <td class="px-4 py-3 text-ms border">{{$data->positionMapping->supervisor->personalData->position->name}}</td>
              <td class="px-4 py-3 text-ms border font-semibold">4</td>
              <td class="px-4 py-3 text-ms border font-semibold">Jabatan</td>
              <td class="px-4 py-3 text-ms border">{{$data->user->personalData->position->name}}</td>
            </tr>
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">5</td>
              <td class="px-4 py-3 text-ms border font-semibold">Unit Kerja</td>
              <td class="px-4 py-3 text-ms border">{{$data->positionMapping->supervisor->personalData->workUnit->name}}</td>
              <td class="px-4 py-3 text-ms border font-semibold">5</td>
              <td class="px-4 py-3 text-ms border font-semibold">Unit Kerja</td>
              <td class="px-4 py-3 text-ms border">{{$data->user->personalData->workUnit->name}}</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="w-full overflow-x-auto py-5">
        <table class="w-full">
          <thead>
            <tr>
              <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                No
              </th>
              <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Rencana Kinerja Atasan Langsung Yang Diintervensi
              </th>
              <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Rencana Kinerja
              </th>
              <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Butir Kegiatan
              </th>
              <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Kuantitas | Kualitas | Waktu
              </th>
              <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Angka Kredit
              </th>
            </tr>
          </thead>
          <tbody class="bg-white">
            @foreach($activities as $activity)
            <tr>
              <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center text-center text-center">
                <p class="text-gray-900 whitespace-no-wrap">
                  {{$loop->iteration}}
                </p>
              </td>
              <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center text-center">
                <p class="text-gray-900 whitespace-no-wrap">
                  {{$activity->refPerformanceElement->direct_supervisor_performance_plan}}
                </p>
              </td>
              <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center text-center">
                <p class="text-gray-900 whitespace-no-wrap">
                  {{$activity->refPerformanceElement->performance_plan}}
                </p>
              </td>
              <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center text-center">
                <p class="text-gray-900 whitespace-no-wrap">
                  {{$activity->refPerformanceElement->activity_item}}
                </p>
              </td>
              <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center text-center">
                <p class="text-gray-900 whitespace-no-wrap">
                  {{$activity->target_qty}} | {{$activity->target_quality}}% | {{$activity->target_time}} Bulan
                </p>
              </td>
              <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center text-center">
                <p class="text-gray-900 whitespace-no-wrap">
                  {{$activity->target_credit_score}}
                </p>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <div class="w-full overflow-x-auto py-5">
        <table class="w-full">
          <thead>
            <tr>
              <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                No
              </th>
              <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                IV. Perilaku Kerja
              </th>
              <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Nilai
              </th>
            </tr>
          </thead>
          <tbody class="bg-white">
            @foreach($workbehaviours as $workbehaviour)
            <tr>
              <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                <p class="text-gray-900 whitespace-no-wrap">
                  {{$loop->iteration}}
                </p>
              </td>
              <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                <p class="text-gray-900 whitespace-no-wrap">
                  {{$workbehaviour->refNewWorkBehavior->name}}
                </p>
              </td>
              <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                <p class="text-gray-900 whitespace-no-wrap">
                  {{$workbehaviour->score}}
                </p>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="flex items-center justify-center mt-10">
        <div class="w-full max-w-md mr-4">
          <form action="{{ route('divheadnptdone', $data->id)}}" method="POST" class="bg-white shadow-lg rounded px-12 pt-6 pb-8 mb-4 border-2 border-red-500">
            @csrf
            <div class="text-gray-800 text-2xl flex justify-center border-b-2 py-2 mb-4">
              TERBITKAN SKP
            </div>
            <div class="container" id="alertbox">
              <div class="container bg-yellow-500 flex items-center text-white text-sm text-center font-bold px-4 py-3 relative"
              role="alert">
              <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path
                d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z" />
              </svg>
              <p>Jika Penilaian SKP Telah Diterbitkan, Perubahan Sudah Tidak Dapat Dilakukan</p>
            </div>
            <div class="text-gray-800 text-xl flex justify-center border-b-2 py-2 mb-4 mt-4">
              Nilai SKP {{$data->assessment_year}} Periode {{$data->period}} : <b>{{$data->performance_score}}</b>
            </div>
          </div>
          <div class="flex items-center justify-center mt-6">
            <button class="shadow bg-red-600 hover:bg-red-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
              Terbitkan
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
</div>
@endsection
