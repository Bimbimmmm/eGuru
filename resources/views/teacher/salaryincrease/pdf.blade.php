<!DOCTYPE HTML>
<html>
<head>
  <title>Berkas Usulan Kenaikan Gaji Berkala {{$data->user->personalData->name}}</title>

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
            <td><h1 align="center" class="titleff">Alamat : Jl. Perintis RT.VI Telp. (0553) 2022454</h1></td>
          </tr>
          <tr>
            <td><h1 align="center" class="titleff">TIDENG PALE</h1></td>
          </tr>
        </table>
        <hr>
        <div class="columns">
          <div class="column">
            <table class="is-fullwidth">
              <tr>
                <td class="titleff">Nomor : 820.2/{{$decree_head}}/Disdik-I/{{$get_decree_number->month}}/{{$get_decree_number->year}}</td>
              </tr>
              <tr>
                <td class="titleff">Lampiran : -</td>
              </tr>
              <tr>
                <td class="titleff">Perihal : Kenaikan Gaji Berkala a.n {{$data->user->personalData->name}}</td>
              </tr>
            </table>
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
                  <tr>
                    <td class="titleff">Kepada Yth.</td>
                  </tr>
                  <tr>
                    <td class="titleff">Bendaharawan Gaji Sekretariat Daerah</td>
                  </tr>
                  <tr>
                    <td class="titleff">Kabupaten Tana Tidung</td>
                  </tr>
                  <tr>
                    <td class="titleff">Di -</td>
                  </tr>
                  <tr>
                    <td class="titleff">Tempat</td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="columns is-centered">
          <h1 align="center" class="titleff">Dengan ini diberitahukan bahwa dengan telah dipenuhinya masa kerja dan syarat - syarat lainnya kepada :</h1></td>
        </div>
        <br>
        <div class="columns">
          <h1 align="center" class="titleff">1. Nama / Tanggal Lahir : {{$data->user->personalData->name}}</h1>
        </div>
        <div class="columns">
          <h1 align="center" class="titleff">2. Nomor Induk Pegawai : {{$data->user->personalData->registration_number}}</h1>
        </div>
        <div class="columns">
          <h1 align="center" class="titleff">3. Pangkat / Jabatan : {{$data->user->personalData->rank->rank}}, {{$data->user->personalData->rank->group}} / {{$data->user->personalData->position->name}}</h1>
        </div>
        <div class="columns">
          <h1 align="center" class="titleff">4. Unit Kerja : {{$data->user->personalData->workUnit->name}}</h1>
        </div>
        <div class="columns">
          <h1 align="center" class="titleff">5. Gaji Pokok Lama : {{$data->old_salary}}</h1>
        </div>
        <br>
        <div class="columns is-centered">
            <h1 align="center" class="title is-6">ATAS DASAR SURAT KEPUTUSAN TERAKHIR DARI :</h1></td>
        </div>
        <br>
        <div class="columns">
          <h1 class="titleff">a. Oleh Pejabat : Bupati Tana Tidung</h1></td>
        </div>
        <div class="columns">
          <h1 class="titleff">b. Tanggal / Nomor : {{$data->old_decree_date->isoFormat('D MMMM Y')}} / {{$data->old_decree_number}}</h1></td>
        </div>
        <div class="columns">
          <h1 class="titleff">c. Tanggal Mulai Gaji tsb : {{$data->old_date->isoFormat('D MMMM Y')}}</h1></td>
        </div>
        <div class="columns">
          <h1 class="titleff">d. Masa Kerja Golongan Pada tgl tsb : {{$data->old_work_year}}</h1></td>
        </div>
        <br>
        <div class="columns is-centered">
            <h1 align="center" class="title is-6">DIBERIKAN KENAIKAN GAJI BERKALA SEHINGGA MEMPEROLEH :</h1></td>
        </div>
        <br>
        <div class="columns">
          <h1 class="titleff">6. Gaji Pokok Baru : {{$data->new_salary}}</h1></td>
        </div>
        <div class="columns">
          <h1 class="titleff">7. Berdasarkan Masa Kerja : {{$data->new_work_year}}</h1></td>
        </div>
        <div class="columns">
          <h1 class="titleff">8. Dalam Golongan : {{$data->user->personalData->rank->group}}</h1></td>
        </div>
        <div class="columns">
          <h1 class="titleff">9. Mulai Tanggal : {{$data->new_date->isoFormat('D MMMM Y')}}</h1></td>
        </div>
        <div class="columns">
          <h1 class="titleff">10. Keterangan : Untuk Kenaikan Gaji Berkala Yang Akan Datang TMT {{$data->new_date->isoFormat('D MMMM')}} {{$next_tmt}}</h1></td>
        </div>
        <br>
        <div class="columns">
          <h1 class="titleff">Diharapkan agar seusai dengan Peraturan Pemerintah No. 15 Tahun 2019 kepada Pegawai Negeri Sipil Tersebut dapat dibayarkan penghasilannya berdasarkan Gaji Pokok yang baru.</h1></td>
        </div>
        <div class="columns">
          <div class="column">
            <div class="column">
              <div class="columns">
                <div class="column">
                  <div class="colums">
                    <b><u><i>Tembusan Disampaikan Kepada,</i></u></b>
                  </div>
                  <div class="titleff" class="colums">
                    1. Menteri Dalam Negeri di Jakarta
                  </div>
                  <div class="titleff" class="colums">
                    2. Kepala Kantor Regional VIII BKN Banjarmasin di Banjarbaru
                  </div>
                  <div class="titleff" class="colums">
                    3. Kepala Cabang PT. TASPEN (Persero) Jl. Ir. H. Juanda di Samarinda
                  </div>
                  <div class="titleff" class="colums">
                    4. Kepala Biro Kepegawaian (Bag.TUK) Setda Prop. Kaltim di Samarinda
                  </div>
                  <div class="titleff" class="colums">
                    5. Kepala Biro Keuangan Setda Prop. Kaltim di Samarinda
                  </div>
                  <div class="titleff" class="colums">
                    6. Kepala Bagian Keuangan Setda Kab. Tana Tidung di Tideng Pale
                  </div>
                  <div class="titleff" class="colums">
                    7. Kepala BKD Kabupaten Tana Tidung di Tideng Pale
                  </div>
                  <div class="titleff" class="colums">
                    8. Saudara {{$data->user->personalData->name}}
                  </div>
                </div>
              </div>
            </div>
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
