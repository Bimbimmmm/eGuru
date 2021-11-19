@extends('layouts.teacher')
@section('content')
<div class="min-h-screen bg-white py-14">
  <div class="px-5 mx-auto max-w-7x1">
    <h1 class="mb-12 text-center text-3xl text-black font-bold">Form Penambahan Kegiatan Pengembangan Keprofesian Berkelanjutan</h1>
    <div class="md:flex md:justify-center md:space-x-8 md:px-14">
      <form action="{{ route('teacherptastoreactivity', $id)}}" method="POST" class="w-full max-w-lg">
        @csrf
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
        <div class="flex flex-wrap -mx-3 mb-6">
          <div class="w-full px-3">
            <label class="block dark:text-white uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
              Kegiatan Tugas Jabatan
            </label>
            <select name="reference_activity_credit_score_id" id="reference_activity_credit_score_id" class="appearance-none w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 ">
              <option>Pilih Kegiatan Tugas Jabatan</option>
              @foreach($datas as $data)
              <option value="{{$data->id}}">{{$data->grain_item}} {{$data->sub_grain_item}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="flex flex-col -mx-3 mb-6">
          <div class="w-full px-3">
            <label class="block dark:text-white uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
              Target Kuantitas
            </label>
            <input name="target_qty" id="target_qty" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" required>
          </div>
        </div>
        <div class="flex flex-col -mx-3 mb-6">
          <div class="w-full px-3">
            <label class="block dark:text-white uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
              Target Kualitas
            </label>
            <input name="target_quality" id="target_quality" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" required>
          </div>
        </div>
        <div class="flex flex-col -mx-3 mb-6">
          <div class="w-full px-3">
            <label class="block dark:text-white uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
              Target Waktu
            </label>
            <input name="target_time" id="target_time" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="number" required>
          </div>
        </div>
        <div class="flex flex-col -mx-3 mb-6">
          <div class="w-full px-3">
            <label class="block dark:text-white uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
              Target Unit Waktu
            </label>
            <select name="target_time_unit" id="target_time_unit" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
              <option>Pilih Unit Waktu</option>
              <option value="Hari">Hari</option>
              <option value="Bulan">Bulan</option>
            </select>
          </div>
        </div>
        <div class="flex flex-col -mx-3 mb-6">
          <div class="w-full px-3">
            <label class="block dark:text-white uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
              Target Biaya
            </label>
            <input name="target_cost" id="target_cost" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" required>
          </div>
        </div>
        <div class="md:flex md:items-center">
          <div class="md:w-1/3">
            <button class="shadow bg-green-600 hover:bg-green-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
              Submit
            </button>
            <button onclick="window.location='{{ url ('/teacher/performance/show', array("$id")) }}'" class="shadow bg-red-600 hover:bg-red-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="button">
              Cancel
            </button>
          </div>
          <div class="md:w-2/3"></div>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
var rupiah = document.getElementById('target_cost');
rupiah.addEventListener('keyup', function(e){
  // tambahkan 'Rp.' pada saat form di ketik
  // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
  rupiah.value = formatRupiah(this.value, 'Rp. ');
});

/* Fungsi formatRupiah */
function formatRupiah(angka, prefix){
  var number_string = angka.replace(/[^,\d]/g, '').toString(),
  split   		= number_string.split(','),
  sisa     		= split[0].length % 3,
  rupiah     		= split[0].substr(0, sisa),
  ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

  // tambahkan titik jika yang di input sudah menjadi angka ribuan
  if(ribuan){
    separator = sisa ? '.' : '';
    rupiah += separator + ribuan.join('.');
  }

  rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
  return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
}
</script>
@endsection
