@extends('layouts.teacher')
@section('content')
<div class="min-h-screen bg-white py-14">
  <div class="px-5 mx-auto max-w-7x1">
    <h1 class="mb-12 text-center text-3xl text-black font-bold">Form Penambahan Kinerja Utama</h1>
    <div class="md:flex md:justify-center md:space-x-8 md:px-14">
      <form action="{{ route('teachernptastoremain', $id)}}" method="POST" class="w-full max-w-lg">
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
        <div class="flex flex-col -mx-3 mb-6">
          <div class="w-full px-3">
            <label class="block dark:text-white uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
              Rencana Kinerja Atasan Langsung Yang Diintervensi <span class="text-xs text-yellow-500"><i>*akan tampil setelah memilih butir kegiatan</i>
            </label>
            <textarea name="direct_supervisor_performance_plan" id="direct_supervisor_performance_plan" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" disabled></textarea>
          </div>
        </div>
        <div class="flex flex-col -mx-3 mb-6">
          <div class="w-full px-3">
            <label class="block dark:text-white uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
              Rencana Kinerja <span class="text-xs text-yellow-500"><i>*akan tampil setelah memilih butir kegiatan</i>
            </label>
            <textarea name="performance_plan" id="performance_plan" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" disabled></textarea>
          </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
          <div class="w-full px-3">
            <label class="block dark:text-white uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
              Butir Kegiatan <span class="text-xs text-red-500"><i>*reuqired</i>
            </label>
            <select name="reference_performance_target_element_id" id="reference_performance_target_element_id" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
              <option>Pilih Butir Kegiatan</option>
              @foreach($datas as $data)
              <option value="{{$data->id}}">{{$data->activity_item}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div id ="cs" class="flex flex-col -mx-3 mb-6" style="display:none;">
          <div class="w-full px-3">
            <label class="block dark:text-white uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
              Target Angka Kredit <span class="text-xs text-red-500"><i>*reuqired</i>
            </label>
            <input name="target_credit_score" id="target_credit_score" placeholder="Masukkan Angka Kredit" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="number" step=".001">
          </div>
        </div>
        <div id ="qty" class="flex flex-col -mx-3 mb-6" style="display:none;" class="flex flex-col -mx-3 mb-6">
          <div class="w-full px-3">
            <label class="block dark:text-white uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
              Target Kuantitas <span class="text-xs text-red-500"><i>*reuqired</i>
            </label>
            <input name="target_quantity" id="target_quantity" placeholder="Masukkan Target Kuantitas" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text">
          </div>
        </div>
        <div class="flex flex-col -mx-3 mb-6">
          <div class="w-full px-3">
            <label class="block dark:text-white uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
              Target Mutu <span class="text-xs text-red-500"><i>*reuqired</i>
            </label>
            <input name="target_quality" id="target_quality" placeholder="Masukkan Target Mutu" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" required>
          </div>
        </div>
        <div class="flex flex-col -mx-3 mb-6">
          <div class="w-full px-3">
            <label class="block dark:text-white uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
              Target Waktu <span class="text-xs text-red-500"><i>*reuqired</i>
            </label>
            <input name="target_time" id="target_time" placeholder="Masukkan Target Waktu" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" min="1" max="12" type="number" required>
          </div>
        </div>
        <div class="md:flex md:items-center">
          <div class="md:w-1/3">
            <button class="shadow bg-green-600 hover:bg-green-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
              Submit
            </button>
            <button onclick="window.location='{{ url ('/teacher/newperformance/show', array("$id")) }}'" class="shadow bg-red-600 hover:bg-red-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="button">
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
$('#reference_performance_target_element_id').on('change', function () {

  if (this.value === '1'){
    $("#cs").show();
    $("#qty").hide();
  } else if (this.value === '2'){
    $("#cs").show();
    $("#qty").hide();
  }else if (this.value === '3'){
    $("#cs").show();
    $("#qty").hide();
  }else if (this.value === '4'){
    $("#cs").show();
    $("#qty").hide();
  }else if (this.value === '5'){
    $("#cs").show();
    $("#qty").hide();
  }else if (this.value === '6'){
    $("#cs").show();
    $("#qty").hide();
  }else if (this.value === '7'){
    $("#cs").show();
    $("#qty").hide();
  }else if (this.value === '8'){
    $("#cs").show();
    $("#qty").hide();
  }else if (this.value === '9'){
    $("#cs").show();
    $("#qty").hide();
  }else if (this.value === '10'){
    $("#cs").show();
    $("#qty").hide();
  }else if (this.value === '11'){
    $("#cs").show();
    $("#qty").hide();
  }else if (this.value === '12'){
    $("#cs").show();
    $("#qty").hide();
  }else if (this.value === '13'){
    $("#cs").show();
    $("#qty").hide();
  }else if (this.value === '14'){
    $("#cs").show();
    $("#qty").hide();
  }else if (this.value === '15'){
    $("#cs").show();
    $("#qty").hide();
  }else if (this.value === '16'){
    $("#cs").show();
    $("#qty").hide();
  }else if (this.value === '17'){
    $("#cs").show();
    $("#qty").hide();
  }else if (this.value === '18'){
    $("#cs").show();
    $("#qty").hide();
  }else if (this.value === '19'){
    $("#cs").show();
    $("#qty").hide();
  }else {
    $("#cs").hide();
    $("#qty").show();
  }
});
</script>
<script>
$(document).ready(function() {
  $('#reference_performance_target_element_id').on('change', function() {
    var id = $(this).val();
    if(id) {
      $.ajax({
        url: '/getActivity/'+id,
        type: "GET",
        data : {"_token":"{{ csrf_token() }}"},
        dataType: "json",
        success:function(data)
        {
          if(data){
            $('#direct_supervisor_performance_plan').empty();
            $('#direct_supervisor_performance_plan').append(data.direct_supervisor_performance_plan);
            $('#performance_plan').empty();
            $('#performance_plan').append(data.performance_plan);
          }else{
            $('#direct_supervisor_performance_plan').empty();
            $('#performance_plan').empty();
          }
        }
      });
    }else{
      $('#direct_supervisor_performance_plan').empty();
      $('#performance_plan').empty();
    }
  });
});
</script>
@endsection
