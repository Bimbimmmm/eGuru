<!DOCTYPE HTML>
<html>
<head>
  <title>Pemetaan Guru {{$detail->workUnit->name}} Tahun {{$detail->study_year}} oleh {{$detail->user->personalData->name}}</title>

  <link rel="shortcut icon" href="/images/logo.png" />
  <!-- Styles -->
  <link rel="stylesheet" type="text/css" href= "/css/simacan/bulma.min.css">
  <link rel="stylesheet" type="text/css" href= "/css/simacan/bulma.css">
  <link rel="stylesheet" type="text/css" href= "/css/simacan/app.css">
  <link rel="stylesheet" type="text/css" href= "/css/simacan/all.css">
  <link rel="stylesheet" type="text/css" href= "/css/simacan/recapdupak.css">
  <link rel="stylesheet" type="text/css" href= "/css/simacan/fontawesome.css">
  <link rel="stylesheet" type="text/css" href= "/css/simacan/fontawesome.min.css">

</head>
<body>
  <main class="py-4">
    <div class="container">
      <div class="box is-box">
        <table class="is-fullwidth is-centered">
          <tr>
            <td rowspan="5">
              <img src="{{asset('images/logo.png ') }}" height="65px" width="65px" style="display: block; margin: left;">
            </br>
            </td>
            <td><h1 align="center" class="title is-6">PEMERINTAH KABUPATEN TANA TIDUNG</h1></td>
            <td rowspan="5"><br /></td>
          </tr>
          <tr>
            <td><h1 align="center" class="title is-6">DINAS PENDIDIKAN</h1></td>
          </tr>
          <tr>
            <td><h1 align="center" class="titlef">Alamat : Jl. Perintis RT.VI Telp. (0553) 2022454</h1></td>
          </tr>
          <tr>
            <td><h1 align="center" class="titlef">TIDENG PALE</h1></td>
          </tr>
        </table>
        <hr>
        <div class="columns">
          <h1 class="subtitlef"><b>Nama Sekolah : {{$detail->workUnit->name}}</b></h1>
        </div>
        <div class="columns">
          <h1 class="subtitlef"><b>Tahun Pemetaan : {{$detail->study_year}}</b></h1>
        </div>
        <div class="columns">
          <h1 class="subtitlef"><b>Nama Kepala Sekolah : {{$detail->user->personalData->name}}</b></h1>
        </div>
        <div class="columns">
          <h1 class="subtitlef"><b>Jumlah Rombel : {{$detail->total_study_group}}</b></h1>
        </div>
        <div class="columns">
          <h1 class="subtitlef"><b>Jumlah Siswa : {{$detail->total_student}}</b></h1>
        </div>
        <table class="table is-centered centered-font is-striped is-bordered is-fullwidth">
          <thead>
            <th>No</th>
            <th>Kelompok Mata Pelajaran</th>
            <th>Nama Mata Pelajaran</th>
            <th>Total Jumlah Jam Pelajaran</th>
            <th>Jumlah Guru Yang Dibutuhkan</th>
            <th>Jumlah Guru PNS Yang Ada</th>
            <th>Keterangan</th>
          </thead>
          <tbody>
            @foreach($datas as $data)
            <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$data->referenceSubject->subject_type}}</td>
            <td>{{$data->referenceSubject->name}}</td>
            <td>{{$data->total_hour}}</td>
            <td>{{$data->total_teacher_need}}</td>
            <td>{{$data->total_teacher}}</td>
            @if($data->is_excess == TRUE)
            <td>Kelebihan Guru</td>
            @elseif($data->is_ideal == TRUE)
            <td>Ideal</td>
            @elseif($data->is_lack == TRUE)
            <td>Kekurangan Guru</td>
            @endif
            </tr>
            @endforeach
          </tbody>
        </table>
        <div class="column">
          <div class="columns">
            <div class="column">
              <table class="is-centered custom_table"  style="border: 0px solid transparent;">
                <tr>
                    <th>Tideng Pale, {{$detail->created_at->isoFormat("DD MMMM YYYY")}}</th>
                </tr>
                <tr>
                    <th>Kepala Sekolah,</th>
                </tr>
                  <tr>
                      <td>
                          {!! QrCode::size(75)->generate($userqrcode); !!}
                      </td>
                  </tr>
                  <tr>
                      <td>
                          <u>{{$detail->user->personalData->name}}</u>
                      </td>
                  </tr>
                  <tr>
                      <td>
                          NIP. {{$detail->user->personalData->registration_number}}
                      </td>
                  </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
</body>
</html>
