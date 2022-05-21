<!DOCTYPE HTML>
<html>
<head>
  @foreach($datas as $data)
  <title>Berkas Usulan Cuti {{$data->user->personalData->name}}</title>
  @endforeach
  <link rel="shortcut icon" href="/images/logo.png" />


  <!-- Styles -->
  <link rel="stylesheet" type="text/css" href= "/css/simacan/bulma.min.css">
  <link rel="stylesheet" type="text/css" href= "/css/simacan/bulma.css">
  <link rel="stylesheet" type="text/css" href= "/css/simacan/app.css">
  <link rel="stylesheet" type="text/css" href= "/css/simacan/all.css">
  <link rel="stylesheet" type="text/css" href= "/css/simacan/pdf.css">
  <link rel="stylesheet" type="text/css" href= "/css/simacan/fontawesome.css">
  <link rel="stylesheet" type="text/css" href= "/css/simacan/fontawesome.min.css">

</head>
<body>
  <main class="py-4">
    <div class="container">
      <div class="box is-box is-lined">
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
          <div class="column">
          </div>
          <div class="column">
            <div class="columns">
              <div class="column">
              </div>
              <div class="column">
                <table class="is-fullwidth">
                  <tr>
                    <td>Tideng Pale, {{$get_decree_number->updated_at->isoFormat('D MMMM Y')}}</td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="columns is-centered">
          <h1 align="center" class="title is-5"><u>Surat Izin {{$detail->leaveType->name}}</u></h1></td>
        </div>
        <div class="columns is-centered">
          <h1 align="center" class="titleff">Nomor : 822.2/{{$decree_head}}/Disdik-I/{{$get_decree_number->month}}/{{$get_decree_number->year}}</h1></td>
        </div>
        <br>
        <div class="columns">
          <h1 align="center" class="titleff">Diberikan {{$detail->leaveType->name}} kepada Pegawai Negeri Sipil :</h1></td>
        </div>
        <br>
        <div class="columns">
          <h1 align="center" class="titleff">Nama Lengkap : {{$detail->user->personalData->name}}</h1></td>
        </div>
        <div class="columns">
          <h1 align="center" class="titleff">NIP : {{$detail->user->personalData->registration_number}}</h1></td>
        </div>
        <div class="columns">
          <h1 align="center" class="titleff">Pangkat, Golongan Ruang : {{$detail->user->personalData->rank->rank}}, {{$detail->user->personalData->rank->group}}</h1></td>
        </div>
        <div class="columns">
          <h1 align="center" class="titleff">Jabatan : {{$detail->user->personalData->position->name}}</h1></td>
        </div>
        <div class="columns">
          <h1 align="center" class="titleff">Unit Kerja : {{$detail->user->personalData->workUnit->name}}</h1></td>
        </div>
        <br>
        <div class="columns">
            <h1 class="titleff">Selama {{$detail->leave_duration}} Hari Kerja, terhitung mulai tanggal {{$detail->start_date->isoFormat('D MMMM Y')}} sampai dengan {{$detail->end_date->isoFormat('D MMMM Y')}} dengan ketentuan sebagai berikut :</h1></td>
        </div>
        <br>
        <div class="columns">
          <h1 class="titleff">a. Sebelum menjalankan {{$detail->leaveType->name}} wajib menyerahkan pekerjaan kepada atasan langsungnya atau pejabat lain yang ditunjuk.</h1></td>
        </div>
        <div class="columns">
          <h1 class="titleff">b. Setelah selesai menjalankan {{$detail->leaveType->name}} wajib melaporkan diri kepada atasan langsungnya dan bekerja kembali sebagaimana biasa.</h1></td>
        </div>
        <br>
        <div class="columns">
          <h1 class="titleff">Demikian Surat Izin  {{$detail->leaveType->name}} ini dibuat untuk dapat digunakan sebagaimana mestinya.</h1></td>
        </div>
        <div class="columns">
          <div class="column">

          </div>
          <div class="column">
            <div class="columns">
              <div class="column">
                <table class="is-centered custom_table"  style="border: 0px solid transparent;">
                  <tr>
                      <th>Kepala Dinas,</th>
                  </tr>
                    <tr>
                        <td>
                            {!! QrCode::size(75)->generate($officialqrcode); !!}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <u>(Jafar Sidik, SE.)</u>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            NIP. 19701010 200312 2 006
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
