<!DOCTYPE HTML>
<html>
<head>
  <title>Berita Acara Penilaian Angka Kredit {{$get_yearly_assessment_data->personalData->name}}</title>

  <link rel="shortcut icon" href="/image/kaltara.png" />
  <!-- Styles -->
  <link rel="stylesheet" type="text/css" href= "/css/bulma.min.css">
  <link rel="stylesheet" type="text/css" href= "/css/bulma.css">
  <link rel="stylesheet" type="text/css" href= "/css/app.css">
  <link rel="stylesheet" type="text/css" href= "/css/all.css">
  <link rel="stylesheet" type="text/css" href= "/css/bappdf.css">
  <link rel="stylesheet" type="text/css" href= "/css/fontawesome.css">
  <link rel="stylesheet" type="text/css" href= "/css/fontawesome.min.css">

</head>
<body>
  <main class="py-4">
    <div class="container">
      <div class="box is-box">
        <h1 align="center" class="titlef is-5"><b>BERITA ACARA PENILAIAN ANGKA KREDIT</b></h1>
        <h1 align="center" class="titlef is-5"><b>TAHUN {{$get_yearly_assessment_data->performanceTarget->assessment_year}}</b></h1>
        <div class="columns">
          <div class="column">
            <h1 align="center" class="subtitleff"><b>Instansi: Dinas Pendidikan dan Kebudayaan Provinsi Kalimantan Utara</b></h1>
          </div>
          <div class="column">
            <h1 align="center" class="subtitleff">Masa Penilaian 01 Januari {{$get_yearly_assessment_data->performanceTarget->assessment_year}} s/d 31 Desember {{$get_yearly_assessment_data->performanceTarget->assessment_year}}</h1>
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
            <td colspan="2">{{$get_yearly_assessment_data->personalData->name}}</td>
          </tr>
          <tr>
            <td>2</td>
            <td colspan="2">NIP</td>
            <td colspan="2">{{$get_yearly_assessment_data->personalData->civil_servant_reg_number}}</td>
          </tr>
          <tr>
            <td>3</td>
            <td colspan="2">NUPTK</td>
            <td colspan="2">{{$get_yearly_assessment_data->cs_unique_number}}</td>
          </tr>
          <tr>
            <td>4</td>
            <td colspan="2">Tempat dan Tanggal Lahir</td>
            <td colspan="2">{{$get_yearly_assessment_data->personalData->place_of_birth}}, {{$get_yearly_assessment_data->personalData->date_of_birth->isoFormat('D MMMM Y')}}</td>
          </tr>
          <tr>
            <td>5</td>
            <td colspan="2">Jenis Kelamin</td>
            <td colspan="2">{{$get_yearly_assessment_data->personalData->gender->name}}</td>
          </tr>
          <tr>
            <td>6</td>
            <td colspan="2">Pendidikan yang telah diperhitungkan angka kreditnya</td>
            <td colspan="2">{{$get_yearly_assessment_data->education->grain_item}}</td>
          </tr>
          <tr>
            <td>7</td>
            <td colspan="2">Pangkat / Golongan ruang / TMT</td>
            <td colspan="2">{{$get_yearly_assessment_data->personalData->rankGroup->rank}} / {{$get_yearly_assessment_data->personalData->rankGroup->group}}</td>
          </tr>
          <tr>
            <td>8</td>
            <td colspan="2">Jabatan Guru / TMT</td>
            <td colspan="2">{{$get_yearly_assessment_data->personalData->functionalPosition->name}}</td>
          </tr>
          <tr>
            <td rowspan="2">9</td>
            <td rowspan="2">Masa Kerja Golongan</td>
            <td>Lama</td>
            <td colspan="2">{{$get_yearly_assessment_data->old_work_year}}</td>
          </tr>
          <tr>
            <td>Baru</td>
            <td colspan="2">{{$get_yearly_assessment_data->new_work_year}}</td>
          </tr>
          <tr>
            <td>10</td>
            <td colspan="2">Jenis Guru</td>
            <td colspan="2">{{$get_yearly_assessment_data->cs_type}}</td>
          </tr>
          <tr>
            <td>11</td>
            <td colspan="2">Unit Kerja</td>
            <td colspan="2">{{$get_yearly_assessment_data->personalData->workUnit->name}}</td>
          </tr>
          <tr>
            <td rowspan="2">12</td>
            <td rowspan="2">Alamat</td>
            <td>Sekolah</td>
            <td colspan="2"></td>
          </tr>
          <tr>
            <td>Rumah</td>
            <td colspan="2">{{$get_yearly_assessment_data->address}}</td>
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
        Nama : {{$get_yearly_assessment_data->personalData->name}}
      </div>
    </div>
    <div class="columns">
      <div class="column">
        NIP : {{$get_yearly_assessment_data->personalData->civil_servant_reg_number}}
      </div>
    </div>
    <div class="columns">
      <div class="column">
        Alamat : {{$get_yearly_assessment_data->address}}
      </div>
    </div>
  </div>
  <div class="column">
    <div class="columns">
      <div class="column">
        Nunukan, {{$get_yearly_assessment_data->assessment_date->isoFormat('D MMMM Y')}}
      </div>
    </div>
    <div class="columns">
      <div class="column">
        Penilai,
      </div>
    </div>
    <div class="columns">
      <div class="column">
        {!! QrCode::size(75)->generate($assesorqrcode); !!}
      </div>
    </div>
    <div class="columns">
      <div class="column">
        Tim Penilai
      </div>
    </div>
  </div>
</div>
</div>

<div class="box is-box">
  <h1 align="center" class="titlef is-5"><b>LEMBAR PENILAIAN PENGEMBANGAN KEPROFESIAN (PKB) GURU</b></h1>
  <h1 align="center" class="titlef is-5"><b>PERIODE TAHUN {{$get_yearly_assessment_data->performanceTarget->assessment_year}}</b></h1>
<div class="columns">
  <div class="column">
    <div class="columns">
    <div class="column">
      Nomor / Tgl Usul :
    </div>
  </div>
  <div class="columns">
    <div class="column">
      Pengusulan Ke :
    </div>
  </div>
  <div class="columns">
    <div class="column">
      Nama : {{$get_yearly_assessment_data->personalData->name}}
    </div>
  </div>
  <div class="columns">
    <div class="column">
      NIP : {{$get_yearly_assessment_data->personalData->civil_servant_reg_number}}
    </div>
  </div>
  <div class="columns">
    <div class="column">
      Tempat, Tanggal Lahir : {{$get_yearly_assessment_data->personalData->place_of_birth}}, {{$get_yearly_assessment_data->personalData->date_of_birth->isoFormat('D MMMM Y')}}
    </div>
  </div>
  <div class="columns">
    <div class="column">
      Pangkat/Gol/Ruang : {{$get_yearly_assessment_data->personalData->rankGroup->rank}} / {{$get_yearly_assessment_data->personalData->rankGroup->group}}
    </div>
  </div>
  <div class="columns">
    <div class="column">
      Unit Kerja : {{$get_yearly_assessment_data->personalData->workUnit->name}}
    </div>
  </div>
</div>
</div>
@php
$num=1;
@endphp
<table class="table is-bordered is-fullwidth">
<thead>
  <tr class="is-centered">
    <th rowspan="2">No</th>
    <th rowspan="2">Kegiatan PKB</th>
    <th colspan="4">Hasil Penilaian</th>
  </tr>
  <tr class="is-centered">
    <th>Kriteria</th>
    <th>No. Alasan Penolakan</th>
    <th>Alasan Penolakan dan Saran</th>
    <th>Nilai</th>
  </tr>
</thead>
<tbody>
@foreach($get_rejected_datas as $get_rejected_data)
<tr>
  <td>{{$num++}}</td>
  <td>{{$get_rejected_data->performanceTarget->activityReference->grain_item}}</td>
  <td></td>
  <td></td>
  <td>{{$get_rejected_data->reason}}</td>
  <td>{{$get_rejected_data->performanceTarget->realization_credit_score}}</td>
</tr>
@endforeach
</tbody>
</table>

</div>
</div>
</main>
</body>
</html>
