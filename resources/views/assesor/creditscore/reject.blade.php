@extends('layouts.assesor')
@section('content')
<div class="min-h-screen bg-gray-200 py-3">
  <a href="/assesor/creditscore/score/{{$idassesmentscore}}/{{$idassesment}}">
    <button class="block text-green-500 rounded-sm font-bold py-4 px-6 mr-2 flex items-center hover:bg-green-500 hover:text-white">
      <svg class="h-5 w-5 mr-2 fill-current" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="-49 141 512 512" style="enable-background:new -49 141 512 512;" xml:space="preserve">
        <path id="XMLID_10_" d="M438,372H36.355l72.822-72.822c9.763-9.763,9.763-25.592,0-35.355c-9.763-9.764-25.593-9.762-35.355,0 l-115.5,115.5C-46.366,384.01-49,390.369-49,397s2.634,12.989,7.322,17.678l115.5,115.5c9.763,9.762,25.593,9.763,35.355,0 c9.763-9.763,9.763-25.592,0-35.355L36.355,422H438c13.808,0,25-11.193,25-25S451.808,372,438,372z"></path>
      </svg>
    </button>
  </a>
  <div class="px-5 mx-auto max-w-7x1">
    <h1 class="mb-12 text-center text-4xl text-black font-bold">Form Penolakan</h1>
    <div class="mx-4 sm:mx-8 px-4 sm:px-8 py-4 overflow-x-auto ">
      <div class="w-full mt-8 overflow-hidden rounded-lg shadow-lg">
        <div class="w-full overflow-x-auto">
          <table class="w-full">
            <tbody class="bg-white">
              <tr class="text-gray-700 text-center">
                <td class="px-4 py-3 text-ms border font-semibold">Nama Kegiatan</td>
                <td class="px-4 py-3 text-ms border">{{$performancetargetscore->refPerformanceElement->performance_plan}} -> {{$performancetargetscore->refPerformanceElement->activity_item}}</td>
              </tr>
              <tr class="text-gray-700 text-center">
                <td class="px-4 py-3 text-ms border font-semibold">Nilai AK</td>
                <td class="px-4 py-3 text-ms border">{{$performancetargetscore->realization_credit_score}}</td>
              </tr>
              <tr class="text-gray-700 text-center">
                <td class="px-4 py-3 text-ms border font-semibold">Jumlah Kegiatan</td>
                <td class="px-4 py-3 text-ms border">{{$performancetargetscore->realization_qty}}</td>
              </tr>
              <form action="{{ route('assesorcrrejectstore', array(
              "$performancetargetscore->id",
              "$idassesmentscore",
              "$idassesment"
              ))}}" method="POST">
                @csrf
              <tr class="text-gray-700 text-center">
                <td class="px-4 py-3 text-ms border font-semibold">Jumlah Kegiatan Yang Ditolak <span class="text-xs text-red-500"><i>*required</i></td>
                <td class="px-4 py-3 text-ms border">
                  <input name="qty" type="number" min="0" max="{{$performancetargetscore->realization_qty}}" placeholder="Masukkan Jumlah Kegiatan Yang Ditolak"class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" required>
                </td>
              </tr>
              <tr class="text-gray-700 text-center">
                <td class="px-4 py-3 text-ms border font-semibold">Alasan Penolakan <span class="text-xs text-red-500"><i>*required</i></td>
                <td class="px-4 py-3 text-ms border">
                  <textarea name="reason" id="reason" type="text" placeholder="Masukkan Alasan Penolakan" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" required></textarea>
                </td>
              </tr>
              <tr class="text-gray-700 text-center">
                <td class="px-4 py-3 text-ms border font-semibold">Saran Perbaikan <span class="text-xs text-red-500"><i>*required</i></td>
                <td class="px-4 py-3 text-ms border">
                  <textarea name="suggestion" id="suggestion" type="text" placeholder="Masukkan Saran Perbaikan" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" required></textarea>
                </td>
              </tr>
            </tbody>
          </table>
          <div class="flex items-center bg-white justify-center">
            <button class="shadow mt-5 mb-5 bg-red-600 hover:bg-red-500 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
              Tolak
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
