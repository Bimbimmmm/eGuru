<!DOCTYPE HTML>
<html>
<head>
  <title>Formulir Sasaran Kerja {{$getdatas->personalData->name}}</title>

  <link rel="shortcut icon" href="/image/kaltara.png" />
  <!-- Styles -->
  <link rel="stylesheet" type="text/css" href= "/css/bulma.min.css">
  <link rel="stylesheet" type="text/css" href= "/css/bulma.css">
  <link rel="stylesheet" type="text/css" href= "/css/app.css">
  <link rel="stylesheet" type="text/css" href= "/css/all.css">
  <link rel="stylesheet" type="text/css" href= "/css/pdf2.css">
  <link rel="stylesheet" type="text/css" href= "/css/fontawesome.css">
  <link rel="stylesheet" type="text/css" href= "/css/fontawesome.min.css">

</head>
<body>
  <main class="py-4">
    <div class="container">
      <div class="box is-box is-lined">
        <h1 align="center" class="titlef is-3"><b>PENILAIAN CAPAIAN SASARAN KERJA</b></h1>
        <h1 align="center" class="titlef is-3"><b>PEGAWAI NEGERI SIPIL</b></h1>
      </br>
        <table class="table is-bordered is-fullwidth">
            <thead>
              <tr>
                <th rowspan="2">NO</th>
                <th rowspan="2">I. KEGIATAN TUGAS JABATAN</th>
                <th align="center" colspan="5">Target</th>
                <th align="center" colspan="5">Realisasi</th>
                <th align="center" rowspan="2">Perhitungan</th>
                <th align="center" rowspan="2">Nilai Capaian SKP</th>
              </tr>
              <tr>
                <th align="center">AK</th>
                <th align="center">KUANT/OUTPUT</th>
                <th align="center">KUAL/MUTU</th>
                <th align="center">WAKTU</th>
                <th align="center">BIAYA</th>
                <th align="center">AK</th>
                <th align="center">KUANT/OUTPUT</th>
                <th align="center">KUAL/MUTU</th>
                <th align="center">WAKTU</th>
                <th align="center">BIAYA</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th>II</th>
                <th colspan="13">Pembelajaran/Bimbingan dan Tugas Tertentu</th>
              </tr>
              <tr>
                <td>1</td>
                <th colspan="13">Melaksanakan Proses Pembelajaran</th>
              </tr>
              @foreach($gets1 as $get1)
              @if($get1 == null)
              @else
              <tr>
                <td></td>
                <td>{{$get1->activityReference->grain_item}}</td>
                <td align="center">{{$get1->target_credit_score}}</td>
                <td align="center">{{$get1->target_qty}} {{$get1->target_output}}</td>
                <td align="center">{{$get1->target_quality}}</td>
                <td align="center">{{$get1->target_time}} Bulan</td>
                <td align="center">{{$get1->target_cost}}</td>
                <td align="center">{{$get1->realization_credit_score}}</td>
                <td align="center">{{$get1->realization_qty}} {{$get1->realization_output}}</td>
                <td align="center">{{$get1->realization_quality}}</td>
                <td align="center">{{$get1->realization_time}} Bulan</td>
                <td align="center">{{$get1->realization_cost}}</td>
                <td align="center">{{$get1->calculation}}</td>
                <td align="center">{{number_format($get1->performance_value, 2)}}</td>
              </tr>
              @endif
              @endforeach
              <tr>
                <td>2</td>
                <th colspan="13">Melaksanakan Proses Bimbingan</th>
              </tr>
              @foreach($gets2 as $get2)
              @if($get2 == null)
              @else
              <tr>
                <td></td>
                <td>{{$get2->activityReference->grain_item}}</td>
                <td align="center">{{$get2->target_credit_score}}</td>
                <td align="center">{{$get2->target_qty}} {{$get2->target_output}}</td>
                <td align="center">{{$get2->target_quality}}</td>
                <td align="center">{{$get2->target_time}} Bulan</td>
                <td align="center">{{$get2->target_cost}}</td>
                <td align="center">{{$get2->realization_credit_score}}</td>
                <td align="center">{{$get2->realization_qty}} {{$get2->realization_output}}</td>
                <td align="center">{{$get2->realization_quality}}</td>
                <td align="center">{{$get2->realization_time}} Bulan</td>
                <td align="center">{{$get2->realization_cost}}</td>
                <td align="center">{{$get2->calculation}}</td>
                <td align="center">{{number_format($get2->performance_value, 2)}}</td>
              </tr>
              @endif
              @endforeach
              <tr>
                <td>3</td>
                <th colspan="13">Melaksanakan tugas lain yang relevan dengan fungsi sekolah</th>
              </tr>
              @if($arr3 == null)
              @else
              @foreach($arr3 as $ar3)
              <tr>
                <td></td>
                <td>{{$ar3->activityReference->grain_item}}</td>
                <td align="center">{{$ar3->target_credit_score}}</td>
                <td align="center">{{$ar3->target_qty}} {{$ar3->target_output}}</td>
                <td align="center">{{$ar3->target_quality}}</td>
                <td align="center">{{$ar3->target_time}} Bulan</td>
                <td align="center">{{$ar3->target_cost}}</td>
                <td align="center">{{$ar3->realization_credit_score}}</td>
                <td align="center">{{$ar3->realization_qty}} {{$ar3->realization_output}}</td>
                <td align="center">{{$ar3->realization_quality}}</td>
                <td align="center">{{$ar3->realization_time}} Bulan</td>
                <td align="center">{{$ar3->realization_cost}}</td>
                <td align="center">{{$ar3->calculation}}</td>
                <td align="center">{{number_format($ar3->performance_value, 2)}}</td>
              </tr>
              @endforeach
              @endif
              <tr>
                <th>III</th>
                <th colspan="13">Pengembangan Keprofesian Berkelanjutan (PKB)</th>
              </tr>
              <tr>
                <td>1</td>
                <th colspan="13">Melaksanakan Pengembangan Diri</th>
              </tr>
              <tr>
                <td></td>
                <th colspan="13">1.1 Mengikuti Diklat Fungsional</th>
              </tr>
              @if($arr4 == null)
              @else
              @foreach($arr4 as $ar4)
              <tr>
                <td></td>
                <td>{{$ar4->activityReference->sub_grain_item}}</td>
                <td align="center">{{$ar4->target_credit_score}}</td>
                <td align="center">{{$ar4->target_qty}} {{$ar4->target_output}}</td>
                <td align="center">{{$ar4->target_quality}}</td>
                <td align="center">{{$ar4->target_time}} Bulan</td>
                <td align="center">{{$ar4->target_cost}}</td>
                <td align="center">{{$ar4->realization_credit_score}}</td>
                <td align="center">{{$ar4->realization_qty}} {{$ar4->realization_output}}</td>
                <td align="center">{{$ar4->realization_quality}}</td>
                <td align="center">{{$ar4->realization_time}} Bulan</td>
                <td align="center">{{$ar4->realization_cost}}</td>
                <td align="center">{{$ar4->calculation}}</td>
                <td align="center">{{number_format($ar4->performance_value, 2)}}</td>
              </tr>
              @endforeach
              @endif
              <tr>
                <td></td>
                <th colspan="13">1.2 Kegiatan Kolektif Guru</th>
              </tr>
              @if($arr41 == null)
              @else
              @foreach($arr41 as $ar41)
              <tr>
                <td></td>
                <td>{{$ar41->activityReference->sub_grain_item}}</td>
                <td align="center">{{$ar41->target_credit_score}}</td>
                <td align="center">{{$ar41->target_qty}} {{$ar41->target_output}}</td>
                <td align="center">{{$ar41->target_quality}}</td>
                <td align="center">{{$ar41->target_time}} Bulan</td>
                <td align="center">{{$ar41->target_cost}}</td>
                <td align="center">{{$ar41->realization_credit_score}}</td>
                <td align="center">{{$ar41->realization_qty}} {{$ar41->realization_output}}</td>
                <td align="center">{{$ar41->realization_quality}}</td>
                <td align="center">{{$ar41->realization_time}} Bulan</td>
                <td align="center">{{$ar41->realization_cost}}</td>
                <td align="center">{{$ar41->calculation}}</td>
                <td align="center">{{number_format($ar41->performance_value, 2)}}</td>
              </tr>
              @endforeach
              @endif
              <tr>
                <td>2</td>
                <th colspan="13">Melaksanakan Publikasi Ilmiah</th>
              </tr>
              @if($arr5 == null)
              @else
              @foreach($arr5 as $ar5)
              <tr>
                <td></td>
                <td>{{$ar5->activityReference->grain_item}} {{$ar5->activityReference->sub_grain_item}}</td>
                <td align="center">{{$ar5->target_credit_score}}</td>
                <td align="center">{{$ar5->target_qty}} {{$ar5->target_output}}</td>
                <td align="center">{{$ar5->target_quality}}</td>
                <td align="center">{{$ar5->target_time}} Bulan</td>
                <td align="center">{{$ar5->target_cost}}</td>
                <td align="center">{{$ar5->realization_credit_score}}</td>
                <td align="center">{{$ar5->realization_qty}} {{$ar5->realization_output}}</td>
                <td align="center">{{$ar5->realization_quality}}</td>
                <td align="center">{{$ar5->realization_time}} Bulan</td>
                <td align="center">{{$ar5->realization_cost}}</td>
                <td align="center">{{$ar5->calculation}}</td>
                <td align="center">{{number_format($ar5->performance_value, 2)}}</td>
              </tr>
              @endforeach
              @endif
              <tr>
                <td>3</td>
                <th colspan="13">Melaksanakan Karya inovatif</th>
              </tr>
              @if($arr6 == null)
              @else
              @foreach($arr6 as $ar6)
              <tr>
                <td></td>
                <td>{{$ar6->activityReference->grain_item}} {{$ar6->activityReference->sub_grain_item}}</td>
                <td align="center">{{$ar6->target_credit_score}}</td>
                <td align="center">{{$ar6->target_qty}} {{$ar6->target_output}}</td>
                <td align="center">{{$ar6->target_quality}}</td>
                <td align="center">{{$ar6->target_time}} Bulan</td>
                <td align="center">{{$ar6->target_cost}}</td>
                <td align="center">{{$ar6->realization_credit_score}}</td>
                <td align="center">{{$ar6->realization_qty}} {{$ar6->realization_output}}</td>
                <td align="center">{{$ar6->realization_quality}}</td>
                <td align="center">{{$ar6->realization_time}} Bulan</td>
                <td align="center">{{$ar6->realization_cost}}</td>
                <td align="center">{{$ar6->calculation}}</td>
                <td align="center">{{number_format($ar6->performance_value, 2)}}</td>
              </tr>
              @endforeach
              @endif
              <tr>
                <th>III</th>
                <th colspan="13">Penunjang Tugas Guru</th>
              </tr>
              <tr>
                <td>1</td>
                <th colspan="13">Memperoleh gelar/ijazah yang tidak sesuai dengan bidang yang diampuhnya</th>
              </tr>
              @if($arr7 == null)
              @else
              @foreach($arr7 as $ar7)
              <tr>
                <td></td>
                <td>{{$ar7->activityReference->sub_grain_item}}</td>
                <td align="center">{{$ar7->target_credit_score}}</td>
                <td align="center">{{$ar7->target_qty}} {{$ar7->target_output}}</td>
                <td align="center">{{$ar7->target_quality}}</td>
                <td align="center">{{$ar7->target_time}} Bulan</td>
                <td align="center">{{$ar7->target_cost}}</td>
                <td align="center">{{$ar7->realization_credit_score}}</td>
                <td align="center">{{$ar7->realization_qty}} {{$ar7->realization_output}}</td>
                <td align="center">{{$ar7->realization_quality}}</td>
                <td align="center">{{$ar7->realization_time}} Bulan</td>
                <td align="center">{{$ar7->realization_cost}}</td>
                <td align="center">{{$ar7->calculation}}</td>
                <td align="center">{{number_format($ar7->performance_value, 2)}}</td>
              </tr>
              @endforeach
              @endif
              <tr>
                <td>2</td>
                <th colspan="13">Melaksanakan kegiatan yang mendukung tugas guru</th>
              </tr>
              @if($arr8 == null)
              @else
              @foreach($arr8 as $ar8)
              <tr>
                <td></td>
                <td>{{$ar8->activityReference->sub_grain_item}}</td>
                <td align="center">{{$ar8->target_credit_score}}</td>
                <td align="center">{{$ar8->target_qty}} {{$ar8->target_output}}</td>
                <td align="center">{{$ar8->target_quality}}</td>
                <td align="center">{{$ar8->target_time}} Bulan</td>
                <td align="center">{{$ar8->target_cost}}</td>
                <td align="center">{{$ar8->realization_credit_score}}</td>
                <td align="center">{{$ar8->realization_qty}} {{$ar8->realization_output}}</td>
                <td align="center">{{$ar8->realization_quality}}</td>
                <td align="center">{{$ar8->realization_time}} Bulan</td>
                <td align="center">{{$ar8->realization_cost}}</td>
                <td align="center">{{$ar8->calculation}}</td>
                <td align="center">{{number_format($ar8->performance_value, 2)}}</td>
              </tr>
              @endforeach
              @endif
              <tr>
                <td>3</td>
                <th colspan="13">Perolehan penghargaan/tanda jasa Satya Lancana Karya Satya</th>
              </tr>
              @if($arr9 == null)
              @else
              @foreach($arr9 as $ar9)
              <tr>
                <td></td>
                @if($ar9->activityReference->_sub_grain_item != null)
                <td>{{$ar9->activityReference->grain_item}} {{$ar9->activityReference->_sub_grain_item}}</td>
                @else
                <td>{{$ar9->activityReference->grain_item}}</td>
                @endif
                <td align="center">{{$ar9->target_credit_score}}</td>
                <td align="center">{{$ar9->target_qty}} {{$ar9->target_output}}</td>
                <td align="center">{{$ar9->target_quality}}</td>
                <td align="center">{{$ar9->target_time}} Bulan</td>
                <td align="center">{{$ar9->target_cost}}</td>
                <td align="center">{{$ar9->realization_credit_score}}</td>
                <td align="center">{{$ar9->realization_qty}} {{$ar9->realization_output}}</td>
                <td align="center">{{$ar9->realization_quality}}</td>
                <td align="center">{{$ar9->realization_time}} Bulan</td>
                <td align="center">{{$ar9->realization_cost}}</td>
                <td align="center">{{$ar9->calculation}}</td>
                <td align="center">{{number_format($ar9->performance_value, 2)}}</td>
              </tr>
              @endforeach
              @endif
              <tr>
                <td colspan="13"></td>
                <th align="center">{{$finalskpscore}}</td>
              </tr>
              <tr>
                <td colspan="13"></td>
                @if($finalskpscore <= 50)
                <th align="center">Buruk</th>
                @elseif($finalskpscore <= 60)
                <th align="center">Sedang</th>
                @elseif($finalskpscore<=75)
                <th align="center">Cukup</th>
                @elseif($finalskpscore<=90)
                <th align="center">Baik</th>
                @else
                <th align="center">Sangat Baik</th>
                @endif
              </tr>
            </tbody>
        </table>
        <div class="columns">
          <div class="column">

        </div>
        <div class="column">
        </br>
      </br>
      <table class="is-centered custom_table"  style="border: 0px solid transparent;">
        <tr>
          <th>Nunukan, 31 Desember {{$getdatas->assessment_year}}</th>
        </tr>
        <tr>
          <th>Pejabat Penilai</th>
        </tr>
          <tr>
              <td>
                  {!! QrCode::size(60)->generate($directspvqrcode); !!}
              </td>
          </tr>
          <tr>
              <td>
                  <u>({{$bossdatas->name}})</u>
              </td>
          </tr>
          <tr>
              <td>
                  NIP. {{$bossdatas->civil_servant_reg_number}}
              </td>
          </tr>
      </table>
      </div>
        </div>
      </div>
<p>Dokumen Ini Ditandatangani Secara Digital Yang Digenerate Secara Mandiri Oleh Sistem SIMACAN Menggunakan Tanda Tangan Elektronik (TTE) Sementara Dikarenakan Masih Dalam Proses Pendaftaran/Sertifikasi Ke Badan Sandi dan Siber Negara (BSSN)</p>
    </div>
  </main>
</body>
</html>
