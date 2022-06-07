<!DOCTYPE HTML>
<html>
<head>
  <title>Penetapan Angka Kredit {{$get_assesment_credit_data->user->personalData->name}}</title>

  <link rel="shortcut icon" href="/images/logo.png" />
  <!-- Styles -->
  <link rel="stylesheet" type="text/css" href= "/css/simacan/bulma.min.css">
  <link rel="stylesheet" type="text/css" href= "/css/simacan/bulma.css">
  <link rel="stylesheet" type="text/css" href= "/css/simacan/app.css">
  <link rel="stylesheet" type="text/css" href= "/css/simacan/all.css">
  <link rel="stylesheet" type="text/css" href= "/css/simacan/bappdf.css">
  <link rel="stylesheet" type="text/css" href= "/css/simacan/fontawesome.css">
  <link rel="stylesheet" type="text/css" href= "/css/simacan/fontawesome.min.css">

</head>
<body>
  <main class="py-4">
    <div class="container">
      <div class="box is-box">
        <h1 align="center" class="titlef is-5"><b>PENETAPAN ANGKA KREDIT</b></h1>
        <h1 align="center" class="titlef is-5"><b>DINAS PENDIDIKAN KABUPATEN TANA TIDUNG</b></h1>
        <h1 align="center" class="titlef is-5"><b>PROVINSI KALIMANTAN UTARA</b></h1>
        <h1 align="center" class="titlef is-5"><b>TAHUN {{$get_assesment_credit_data->newPerformanceTarget->assessment_year}}</b></h1>
        <div class="columns">
          <div class="column">
            <h1 align="center" class="subtitleff"><b>Instansi: Dinas Pendidikan Kabupaten Tana Tidung</b></h1>
          </div>
          <div class="column">
            <h1 align="center" class="subtitleff">Masa Penilaian 01 Januari {{$get_assesment_credit_data->newPerformanceTarget->assessment_year}} s/d 31 Desember {{$get_assesment_credit_data->newPerformanceTarget->assessment_year}}</h1>
          </div>
        </div>
        <table class="table is-bordered is-fullwidth">
          <tr>
            <td rowspan="15"><b>I</b></td>
            <td colspan="5"><b>KETERANGAN PERORANGAN</b></td>
          </tr>
          <tr>
            <td>1</td>
            <td colspan="2">Nama</td>
            <td colspan="2">{{$get_assesment_credit_data->user->personalData->name}}</td>
          </tr>
          <tr>
            <td>2</td>
            <td colspan="2">NIP</td>
            <td colspan="2">{{$get_assesment_credit_data->user->personalData->registration_number}}</td>
          </tr>
          <tr>
            <td>3</td>
            <td colspan="2">NUPTK</td>
            <td colspan="2">{{$get_assesment_credit_data->user->personalData->educator_number}}</td>
          </tr>
          <tr>
            <td>4</td>
            <td colspan="2">Tempat dan Tanggal Lahir</td>
            <td colspan="2">{{$get_assesment_credit_data->user->personalData->birth_place}}, {{$get_assesment_credit_data->user->personalData->birth_date->isoFormat('DD MMMM Y')}}</td>
          </tr>
          <tr>
            <td>5</td>
            <td colspan="2">Jenis Kelamin</td>
            <td colspan="2">{{$get_assesment_credit_data->user->personalData->gender}}</td>
          </tr>
          <tr>
            <td>6</td>
            <td colspan="2">Pendidikan yang telah diperhitungkan angka kreditnya</td>
            <td colspan="2">{{$get_assesment_credit_data->refEduCreditScore->name}}</td>
          </tr>
          <tr>
            <td>7</td>
            <td colspan="2">Pangkat / Golongan ruang / TMT</td>
            <td colspan="2">{{$get_assesment_credit_data->user->personalData->rank->rank}} / {{$get_assesment_credit_data->user->personalData->rank->group}}</td>
          </tr>
          <tr>
            <td>8</td>
            <td colspan="2">Jabatan Guru / TMT</td>
            <td colspan="2">{{$get_assesment_credit_data->user->personalData->position->name}}</td>
          </tr>
          <tr>
            <td rowspan="2">9</td>
            <td rowspan="2">Masa Kerja Golongan</td>
            <td>Lama</td>
            <td colspan="2">{{$get_assesment_credit_data->old_work_year}}</td>
          </tr>
          <tr>
            <td>Baru</td>
            <td colspan="2">{{$get_assesment_credit_data->new_work_year}}</td>
          </tr>
          <tr>
            <td>10</td>
            <td colspan="2">Jenis Guru</td>
            <td colspan="2">{{$get_assesment_credit_data->user->personalData->teacher_type}}</td>
          </tr>
          <tr>
            <td>11</td>
            <td colspan="2">Unit Kerja</td>
            <td colspan="2">{{$get_assesment_credit_data->user->personalData->workUnit->name}}</td>
          </tr>
          <tr>
            <td rowspan="2">12</td>
            <td rowspan="2">Alamat</td>
            <td>Sekolah</td>
            <td colspan="2">
              {{$get_assesment_credit_data->user->personalData->workUnit->address}},
              {{$get_assesment_credit_data->user->personalData->workUnit->village}},
              {{$get_assesment_credit_data->user->personalData->workUnit->district}},
              {{$get_assesment_credit_data->user->personalData->workUnit->city}},
              {{$get_assesment_credit_data->user->personalData->workUnit->province}}
            </td>
          </tr>
          <tr>
            <td>Rumah</td>
              <td colspan="2">
                {{$get_assesment_credit_data->user->personalData->address}},
                {{$get_assesment_credit_data->user->personalData->village}},
                {{$get_assesment_credit_data->user->personalData->district}},
                {{$get_assesment_credit_data->user->personalData->city}},
                {{$get_assesment_credit_data->user->personalData->province}}
              </td>
          </tr>
          <tr>
            <td rowspan="19"><b>II</b></td>
            <td colspan="2"><b>Penetapan Angka Kredit</b></td>
            <td><b>LAMA</b></td>
            <td><b>BARU</b></td>
            <td><b>JUMLAH</b></td>
          </tr>
          <tr>
            <td rowspan="12"><b>1</b></td>
            <td><b>Unsur Utama</b></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td>a. Pendidikan</td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td>1) Pendidikan sekolah dan memperoleh gelar ijazah</td>
            <td>{{$arr_count1[1]}}</td>
            <td>{{$arr_count1[0]}}</td>
            <td>{{$arr_count1[2]}}</td>
          </tr>
          <tr>
            <td>2) Mengikuti pelatihan prajabatan</td>
            <td>{{$arr_count2[1]}}</td>
            <td>{{$arr_count2[0]}}</td>
            <td>{{$arr_count2[2]}}</td>
          </tr>
          <tr>
            <td>b. Pembelajaran /  bimbingan dan tugas tertentu</td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td>1) Proses pembelajaran</td>
            <td>{{$arr_count3[1]}}</td>
            <td>{{$arr_count3[0]}}</td>
            <td>{{$arr_count3[2]}}</td>
          </tr>
          <tr>
            <td>2) Proses bimbingan</td>
            <td>{{$arr_count4[1]}}</td>
            <td>{{$arr_count4[0]}}</td>
            <td>{{$arr_count4[2]}}</td>
          </tr>
          <tr>
            <td>3) Tugas lain yang relevan</td>
            <td>{{$arr_count5[1]}}</td>
            <td>{{$arr_count5[0]}}</td>
            <td>{{$arr_count5[2]}}</td>
          </tr>
          <tr>
            <td>c. Pengembangan Keprofesian</td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td>1) Pengembangan diri</td>
            <td>{{$arr_count6[1]}}</td>
            <td>{{$arr_count6[0]}}</td>
            <td>{{$arr_count6[2]}}</td>
          </tr>
          <tr>
            <td>2) Publikasi ilmiah</td>
            <td>{{$arr_count7[1]}}</td>
            <td>{{$arr_count7[0]}}</td>
            <td>{{$arr_count7[2]}}</td>
          </tr>
          <tr>
            <td>3) Karya Inovatif</td>
            <td>{{$arr_count8[1]}}</td>
            <td>{{$arr_count8[0]}}</td>
            <td>{{$arr_count8[2]}}</td>
          </tr>
          <tr>
            <td colspan="2"><b>Jumlah Unsur Utama</b></td>
            <td><b>{{$arr_main[0]}}</b></td>
            <td><b>{{$arr_main[1]}}</b></td>
            <td><b>{{$arr_main[2]}}</b></td>
          </tr>
          <tr>
            <td rowspan="4"><b>2</b></td>
            <td><b>Unsur Penunjang</b></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td>1. Ijazah yang tidak sesuai</td>
            <td>{{$arr_count9[1]}}</td>
            <td>{{$arr_count9[0]}}</td>
            <td>{{$arr_count9[2]}}</td>
          </tr>
          <tr>
            <td>2. Pendukung tugas guru</td>
            <td>{{$arr_count10[1]}}</td>
            <td>{{$arr_count10[0]}}</td>
            <td>{{$arr_count10[2]}}</td>
          </tr>
          <tr>
            <td>3. Perolehan penghargaan/tanda jasa Satya Lancana Karya Satya</td>
            <td>{{$arr_count11[1]}}</td>
            <td>{{$arr_count11[0]}}</td>
            <td>{{$arr_count11[2]}}</td>
          </tr>
          <tr>
            <td colspan="2"><b>Jumlah Unsur Penunjang</b></td>
            <td><b>{{$arr_second[0]}}</b></td>
            <td><b>{{$arr_second[1]}}</b></td>
            <td><b>{{$arr_second[2]}}</b></td>
          </tr>
          <tr>
            <td colspan="3"><b>Jumlah Unsur Utama dan Unsur Penunjang</b></td>
            <td><b>{{$arr_all[0]}}</b></td>
            <td><b>{{$arr_all[1]}}</b></td>
            <td><b>{{$arr_all[2]}}</b></td>
          </tr>
          <tr>
            <td><b>III</b></td>
            <td colspan="6"><b>Dapat Dipertimbangkan Untuk Kenaikan Pangkat : {{$promotion_rank->rank}} / {{$promotion_rank->group}} T.M.T 01 {{$promotion->promotion_period}} {{$nyear}}</b></td>
          </tr>
        </table>
      </br>
    </br>
  </br>
</br>
</br>
</br>
</br>
<div class="columns">
  <div class="column">
    <div class="columns">
      <div class="column">
        <div class="colums">
          KEPADA :
        </div>
        <div class="colums">
          Nama : {{$get_assesment_credit_data->user->personalData->name}}
        </div>
        <div class="colums">
          NIP : {{$get_assesment_credit_data->user->personalData->registration_number}}
        </div>
        <div class="colums">
          Alamat : {{$get_assesment_credit_data->user->personalData->address}}
        </div>
      </div>
    </div>
    <div class="columns">
      <div class="column">
        <div class="colums">
          ASLI disampaikan kepada Kepala Badan Kepegawaian Negara
        </div>
        <div class="colums">
          Kantor Regional VIII Banjarmasin di Banjarbaru
        </div>
      </div>
    </div>
    <div class="columns">
      <div class="column">
        <div class="colums">
          <b><u><i>Tembusan Yth,</i></u></b>
        </div>
        <div class="colums">
          1. Bupati Tana Tidung di Tideng Pale
        </div>
        <div class="colums">
          2. BKD Kab. Tana Tidung di Tideng Pale
        </div>
        <div class="colums">
          3. Kepala {{$get_assesment_credit_data->user->personalData->workUnit->name}}
        </div>
        <div class="colums">
          4. {{$get_assesment_credit_data->user->personalData->name}}
        </div>
      </div>
    </div>
  </div>
  <div class="column">
    <div class="columns">
      <div class="column">
        <div class="columns">
          DITETAPKAN DI : Tideng Pale
        </div>
        <div class="columns">
          PADA TANGGAL : {{$promotion->updated_at->isoFormat('DD MMMM Y')}}
        </div>
      </div>
    </div>
    <div class="columns">
      <div class="column">
        <div class="columns">
          Kepala Dinas,
        </div>
      </div>
    </div>
    <div class="columns">
      <div class="column">
        <div class="columns">
          {!! QrCode::size(75)->generate($assesorqrcode); !!}
        </div>
      </div>
    </div>
    <div class="columns">
      <div class="column">
        <div class="columns">
          <b><u>Jafar Sidik, SE.</u></b>
        </div>
        <div class="columns">
          <b>Pembina Utama Muda</b>
        </div>
        <div class="columns">
          <b>NIP. 19620815 198602 1 005</b>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
</main>
</body>
</html>
