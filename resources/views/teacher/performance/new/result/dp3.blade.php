<!DOCTYPE HTML>
<html>
<head>
    <title>Sasaran Kinerja Pegawai (SKP) {{$getdatas->user->personalData->name}}</title>

    <link rel="shortcut icon" href="/images/logo.png" />
    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href= "/css/simacan/bulma.min.css">
    <link rel="stylesheet" type="text/css" href= "/css/simacan/bulma.css">
    <link rel="stylesheet" type="text/css" href= "/css/simacan/app.css">
    <link rel="stylesheet" type="text/css" href= "/css/simacan/all.css">
    <link rel="stylesheet" type="text/css" href= "/css/simacan/skpdf.css">
    <link rel="stylesheet" type="text/css" href= "/css/simacan/fontawesome.css">
    <link rel="stylesheet" type="text/css" href= "/css/simacan/fontawesome.min.css">

</head>
<body>
    <main class="py-4">
        <div class="container">
            <div class="box is-box is-lined">
                <div class="columns">
                    <div class="column is-lined">
                        <div class="columns is-lined">
                            <div class="column square">
                                <h1 class="subtitlef"><b>8. REKOMENDASI</b></h1>
                            </div>
                        </div>
                        <div class="columns">
                            <div class="column">
                            </div>
                            <div class="column">
                                <h1 class="subtitleff"><b>9. DIBUAT TANGGAL,</b>  31 Desember {{$getdatas->assessment_year}}</h1>
                            </br>
                            <table class="is-centered custom_table"  style="border: 0px solid transparent;">
                                <tr>
                                    <td>
                                        {!! QrCode::size(60)->generate($directspvqrcode); !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <u>({{$directsup->personalData->name}})</u>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        NIP. {{$directsup->personalData->registration_number}}
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    @php
                    $year = $getdatas->assessment_year+1;
                    @endphp
                    <div class="columns">
                        <div class="column">
                            <h1 class="subtitleff"><b>10. DITERIMA TANGGAL,</b>  04 Januari {{$year}}</h1>
                        </br>
                        <table class="is-centered custom_table"  style="border: 0px solid transparent;">
                            <tr>
                                <td>
                                    {!! QrCode::size(60)->generate($userqrcode); !!}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <u>({{$selfdatas->personalData->name}})</u>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    NIP. {{$selfdatas->personalData->registration_number}}
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="column">
                    </div>
                </div>
                <div class="columns">
                    <div class="column">
                    </div>
                    <div class="column">
                        <h1 class="subtitleff"><b>11. DITERIMA TANGGAL,</b>   05 Januari {{$year}}</h1>
                    </br>
                    <table class="is-centered custom_table"  style="border: 0px solid transparent;">
                        <tr>
                            <td>
                                {!! QrCode::size(60)->generate($officialqrcode); !!}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <u>({{$official->personalData->name}})</u>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                NIP. ({{$official->personalData->registration_number}})
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="column">
            <img src="{{asset('images/garuda.png ') }}" height="50px" width="50px" style="display: block; margin: auto;">
            <h1 align="center" class="titlef is-3">PENILAIAN PRESTASI KERJA</h1>
            <h1 align="center" class="titlef is-3">PEGAWAI NEGERI SIPIL</h1>
        </br>
        <div class="columns">
            <div class="column">
                <h1 align="center" class="subtitleff">KEMENTRIAN PENDIDIKAN DAN KEBUDAYAAN</h1>
                <h1 align="center" class="subtitleff">DIREKTORAT JENDRAL PENDIDIKAN DASAR</h1>
                <h1 align="center" class="subtitleff">{{$selfdatas->personalData->workUnit->name}}</h1>
            </div>
            <div class="column">
                <h1 align="center" class="subtitlef">Jangka Waktu Penilaian</h1>
                <h1 align="center" class="subtitlef">01 Januari - 31 Desember {{$getdatas->assessment_year}}</h1>
            </div>
        </div>
        <table class="table is-bordered is-fullwidth">
            <thead>
                <tr>
                    <th colspan="2">1. YANG DINILAI</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>a. Nama</td>
                    <td>{{$selfdatas->personalData->name}}</td>
                </tr>
                <tr>
                    <td>b. NIP</td>
                    <td>{{$selfdatas->personalData->registration_number}}</td>
                </tr>
                <tr>
                    <td>c. Pangkat/Golongan</td>
                    <td>{{$selfdatas->personalData->rank->rank}} / {{$selfdatas->personalData->rank->group}}</td>
                </tr>
                <tr>
                    <td>d. Jabatan</td>
                    <td>{{$selfdatas->personalData->position->name}}</td>
                </tr>
                <tr>
                    <td>e. Unit Kerja</td>
                    <td>{{$selfdatas->personalData->workUnit->name}}</td>
                </tr>
            </tbody>
            <thead>
                <tr>
                    <th colspan="2">2. PEJABAT PENILAI</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>a. Nama</td>
                    <td>{{$directsup->personalData->name}}</td>
                </tr>
                <tr>
                    <td>b. NIP</td>
                    <td>{{$directsup->personalData->registration_number}}</td>
                </tr>
                <tr>
                    <td>c. Pangkat/Golongan</td>
                    <td>{{$directsup->personalData->rank->rank}} / {{$directsup->personalData->rank->group}}</td>
                </tr>
                <tr>
                    <td>d. Jabatan</td>
                    <td>{{$directsup->personalData->position->name}}</td>
                </tr>
                <tr>
                    <td>e. Unit Kerja</td>
                    <td>{{$directsup->personalData->workUnit->name}}</td>
                </tr>
            </tbody>
            <thead>
                <tr>
                    <th colspan="2">3. ATASAN PEJABAT PENILAI</th>
                </tr>
            </thead>
            <tbody>
              <tr>
                  <td>a. Nama</td>
                  <td>{{$official->personalData->name}}</td>
              </tr>
              <tr>
                  <td>b. NIP</td>
                  <td>{{$official->personalData->registration_number}}</td>
              </tr>
              <tr>
                  <td>c. Pangkat/Golongan</td>
                  <td>{{$official->personalData->rank->rank}} / {{$directsup->personalData->rank->group}}</td>
              </tr>
              <tr>
                  <td>d. Jabatan</td>
                  <td>{{$official->personalData->position->name}}</td>
              </tr>
              <tr>
                  <td>e. Unit Kerja</td>
                  <td>{{$official->personalData->workUnit->name}}</td>
              </tr>
            </tbody>
        </table>
    </div>
</div>
</div>
</br>
</br>
</br>
</br>
</br>
<div class="container">
    <div class="box is-box is-lined">
        <div class="columns">
            <div class="column">
                <table class="table is-bordered is-fullwidth">
                    <thead>
                        <tr>
                            <th colspan="3">4. UNSUR YANG DINILAI</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th colspan="2">A. SASARAN KERJA PEGAWAI (SKP) 60%</th>
                            <th>{{$finalskpscore}} x 60%</th>
                            <th>={{$finalscore}}</th>
                        </tr>
                        <tr>
                            <th rowspan="10">B. PERILAKU KERJA 40%</th>
                        </tr>
                        <tr>
                            <td>1. Orientasi Pelayanan</td>
                            <td>{{$scoreget1->score}}</td>
                            @if($scoreget1->score <= 49)
                            <td>Buruk</td>
                            @elseif($scoreget1->score <= 69)
                            <td>Sedang</td>
                            @elseif($scoreget1->score<=89)
                            <td>Cukup</td>
                            @elseif($scoreget1->score<=109.99)
                            <td>Baik</td>
                            @else
                            <td>Sangat Baik</td>
                            @endif
                        </tr>
                        <tr>
                            <td>2. Komitmen</td>
                            <td>{{$scoreget2->score}}</td>
                            @if($scoreget2->score <= 49)
                            <td>Buruk</td>
                            @elseif($scoreget2->score <= 69)
                            <td>Sedang</td>
                            @elseif($scoreget2->score<=89)
                            <td>Cukup</td>
                            @elseif($scoreget2->score<=109.99)
                            <td>Baik</td>
                            @else
                            <td>Sangat Baik</td>
                            @endif
                        </tr>
                        <tr>
                            <td>3. Insiatif Kerja</td>
                            <td>{{$scoreget3->score}}</td>
                            @if($scoreget3->score <= 49)
                            <td>Buruk</td>
                            @elseif($scoreget3->score <= 69)
                            <td>Sedang</td>
                            @elseif($scoreget3->score<=89)
                            <td>Cukup</td>
                            @elseif($scoreget3->score<=109.99)
                            <td>Baik</td>
                            @else
                            <td>Sangat Baik</td>
                            @endif
                        </tr>
                        <tr>
                            <td>4. Kerjasama</td>
                            <td>{{$scoreget4->score}}</td>
                            @if($scoreget4->score <= 49)
                            <td>Buruk</td>
                            @elseif($scoreget4->score <= 69)
                            <td>Sedang</td>
                            @elseif($scoreget4->score<=89)
                            <td>Cukup</td>
                            @elseif($scoreget4->score<=109.99)
                            <td>Baik</td>
                            @else
                            <td>Sangat Baik</td>
                            @endif
                        </tr>
                        <tr>
                            <td>5. Kepemimpinan</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>6. Jumlah</td>
                            <td colspan="2">{{$final}}</td>
                        </tr>
                        <tr>
                            <td>7. Nilai Rata-Rata</td>
                            <td>{{$average}}</td>
                            @if($average <= 49)
                            <td>Buruk</td>
                            @elseif($average <= 69)
                            <td>Sedang</td>
                            @elseif($average<=89)
                            <td>Cukup</td>
                            @elseif($average<=109.99)
                            <td>Baik</td>
                            @else
                            <td>Sangat Baik</td>
                            @endif
                        </tr>
                        <tr>
                            <th>8. Nilai Perilaku Kerja</th>
                            <th>{{$average}} x 40%</th>
                            <th>={{$wb40}}</th>
                        </tr>
                        <tr>
                            <th>NILAI PRESTASI KERJA</th>
                            <th>{{$getdatas->performance_score}}</th>
                            @if($getdatas->performance_score <= 49)
                            <th>Buruk</th>
                            @elseif($getdatas->performance_score <= 69)
                            <th>Sedang</th>
                            @elseif($getdatas->performance_score<=89)
                            <th>Cukup</th>
                            @elseif($getdatas->performance_score<=109.99)
                            <th>Baik</th>
                            @else
                            <th>Sangat Baik</th>
                            @endif
                        </tr>
                    </tbody>
                </table>
                <div class="column is-lined square">
                    <h1 class="subtitlef"><b>5. KEBERATAN DARI PEGAWAI NEGERI SIPIL YANG DINILAI (APABILA ADA)</b></h1>
                </br>
                    <h1 class="subtitlefF is-centered ctn">Tanggal,..........</h1>
                </div>
            </div>
            <div class="column">
                <div class="columns">
                    <div class="column is-lined squaree">
                        <h1 class="subtitlef"><b>6. TANGGAPAN PEJABAT PENILAI ATAS KEBERATAN</b></h1>
                    </br>
                        <h1 class="subtitlefF is-centered ctn">Tanggal,..........</h1>
                    </div>
                </div>
                <div class="columns">
                    <div class="column is-lined squaree">
                        <h1 class="subtitlef"><b>7. TANGGAPAN ATASAN PEJABAT PENILAI ATAS KEBERATAN</b></h1>
                    </br>
                        <h1 class="subtitlefF is-centered ctn">Tanggal,..........</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</br>
<p>Dokumen Ini Ditandatangani Secara Digital Yang Digenerate Secara Mandiri Oleh Sistem eGuru Menggunakan Tanda Tangan Elektronik (TTE) Sementara Dikarenakan Masih Dalam Proses Pendaftaran/Sertifikasi Ke Badan Sandi dan Siber Negara (BSSN)</p>

</div>
</main>
</body>
</html>
