@extends('layouts.teacher')
@section('content')
<div class="min-h-screen bg-gray-200 py-3">
  <a href="/teacher/newcreditscore/show/{{$idc}}">
    <button class="block text-green-500 rounded-sm font-bold py-4 px-6 mr-2 flex items-center hover:bg-green-500 hover:text-white">
      <svg class="h-5 w-5 mr-2 fill-current" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="-49 141 512 512" style="enable-background:new -49 141 512 512;" xml:space="preserve">
        <path id="XMLID_10_" d="M438,372H36.355l72.822-72.822c9.763-9.763,9.763-25.592,0-35.355c-9.763-9.764-25.593-9.762-35.355,0 l-115.5,115.5C-46.366,384.01-49,390.369-49,397s2.634,12.989,7.322,17.678l115.5,115.5c9.763,9.762,25.593,9.763,35.355,0 c9.763-9.763,9.763-25.592,0-35.355L36.355,422H438c13.808,0,25-11.193,25-25S451.808,372,438,372z"></path>
      </svg>
    </button>
  </a>
  <div class="px-5 mx-auto max-w-7x1">
    <h1 class="mb-12 text-center text-4xl text-black font-bold">Detail Kegiatan</h1>
    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
      <div class="w-full overflow-x-auto">
        <table class="w-full">
          <tbody class="bg-white">
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">Nama</td>
              <td class="px-4 py-3 text-ms border">{{$data->refAsCSActivity->activity_item}}</td>
            </tr>
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">Angka Kredit Baru</td>
              <td class="px-4 py-3 text-ms border">{{$data->new_user_credit_score}}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  @if($data->total_user_credit_score == NULL)
  <div class="flex items-center justify-center mt-10">
    <div class="w-full max-w-md mr-4">
      <form action="{{ route('teacherncsupdate', array("$data->id", "$idc"))}}" method="POST" class="bg-white shadow-lg rounded px-12 pt-6 pb-8 mb-4 border-2 border-green-500">
        @csrf
        <div class="text-gray-800 text-2xl flex justify-center border-b-2 py-2 mb-4">
          Form AK Lama
        </div>
        <div class="mb-6">
          <label class="block text-gray-700 text-sm font-normal mb-2" for="password">
            Angka Kredit Lama
          </label>
          <input name="old_credit_score" placeholder="AK Lama Dilihat Pada PAK Tahun Lalu (N-1)" type="number" step=".001" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"/>
        </div>
        <div class="flex items-center justify-center">
          <button class="shadow bg-green-600 hover:bg-green-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
            Submit
          </button>
        </div>
      </form>
    </div>
  </div>
  @endif
</div>
</div>
@endsection
