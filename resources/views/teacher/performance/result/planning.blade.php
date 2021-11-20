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
  <link rel="stylesheet" type="text/css" href= "/css/pdf1.css">
  <link rel="stylesheet" type="text/css" href= "/css/fontawesome.css">
  <link rel="stylesheet" type="text/css" href= "/css/fontawesome.min.css">

</head>
<body>
  <main class="py-4">
    <div class="container">
      <div class="box is-box is-lined">
        <h1 align="center" class="titlef is-3"><b>FORMULIR SASARAN KERJA</b></h1>
        <h1 align="center" class="titlef is-3"><b>PEGAWAI NEGERI SIPIL</b></h1>
      </br>
        <table class="table is-bordered is-fullwidth">
            <thead>
                <tr>
                    <th>No</th>
                    <th colspan="2">I. Pejabat Penilai</th>
                    <th>No</th>
                    <th colspan="5">II. Pegawai Negeri Sipil Yang Dinilai</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>1</th>
                    <td>Nama</td>
                    <td>{{$bossdatas->name}}</td>
                    <th>1</th>
                    <td>Nama</td>
                      <td colspan="2">{{$selfdatas->name}}</td>
                </tr>
                <tr>
                    <th>2</th>
                    <td>NIP</td>
                    <td>{{$bossdatas->civil_servant_reg_number}}</td>
                    <th>2</th>
                    <td>NIP</td>
                    <td colspan="2">{{$selfdatas->civil_servant_reg_number}}</td>
                </tr>
                <tr>
                    <th>3</th>
                    <td>Pangkat/Gol.Ruang</td>
                    <td>{{$bossdatas->rankGroup->rank}} / {{$bossdatas->rankGroup->group}}</td>
                    <th>3</th>
                    <td>Pangkat/Gol.Ruang</td>
                    <td colspan="2">{{$selfdatas->rankGroup->rank}} / {{$selfdatas->rankGroup->group}}</td>
                </tr>
                <tr>
                    <th>4</th>
                    <td>Jabatan</td>
                    <td>{{$bossdatas->functionalPosition->name}}</td>
                    <th>4</th>
                    <td>Jabatan</td>
                    <td colspan="2">{{$selfdatas->functionalPosition->name}}</td>
                </tr>
                <tr>
                    <th>5</th>
                    <td>Unit Kerja</td>
                    <td>{{$bossdatas->workUnit->name}}</td>
                    <th>5</th>
                    <td>Unit Kerja</td>
                    <td colspan="2">{{$selfdatas->workUnit->name}}</td>
                </tr>
            </tbody>
            <thead>
              <tr>
                <th rowspan="2">NO</th>
                <th rowspan="2">I. KEGIATAN TUGAS JABATAN</th>
                <th align="center" colspan="5">Target</th>
              </tr>
              <tr>
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
                <th colspan="6">Pembelajaran/Bimbingan dan Tugas Tertentu</th>
              </tr>
              <tr>
                <td>1</td>
                <th colspan="6">Melaksanakan Proses Pembelajaran</th>
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
              </tr>
              @endif
              @endforeach
              <tr>
                <td>2</td>
                <th colspan="6">Melaksanakan Proses Bimbingan</th>
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
              </tr>
              @endif
              @endforeach
              <tr>
                <td>3</td>
                <th colspan="6">Melaksanakan tugas lain yang relevan dengan fungsi sekolah</th>
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
              </tr>
              @endforeach
              @endif
              <tr>
                <th>III</th>
                <th colspan="6">Pengembangan Keprofesian Berkelanjutan (PKB)</th>
              </tr>
              <tr>
                <td>1</td>
                <th colspan="6">Melaksanakan Pengembangan Diri</th>
              </tr>
              <tr>
                <td></td>
                <th colspan="6">1.1 Mengikuti Diklat Fungsional</th>
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
              </tr>
              @endforeach
              @endif
              <tr>
                <td></td>
                <th colspan="6">1.2 Kegiatan Kolektif Guru</th>
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
              </tr>
              @endforeach
              @endif
              <tr>
                <td>2</td>
                <th colspan="6">Melaksanakan Publikasi Ilmiah</th>
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
              </tr>
              @endforeach
              @endif
              <tr>
                <td>3</td>
                <th colspan="6">Melaksanakan Karya inovatif</th>
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
              </tr>
              @endforeach
              @endif
              <tr>
                <th>III</th>
                <th colspan="6">Penunjang Tugas Guru</th>
              </tr>
              <tr>
                <td>1</td>
                <th colspan="6">Memperoleh gelar/ijazah yang tidak sesuai dengan bidang yang diampuhnya</th>
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
              </tr>
              @endforeach
              @endif
              <tr>
                <td>2</td>
                <th colspan="6">Melaksanakan kegiatan yang mendukung tugas guru</th>
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
              </tr>
              @endforeach
              @endif
              <tr>
                <td>3</td>
                <th colspan="6">Perolehan penghargaan/tanda jasa Satya Lancana Karya Satya</th>
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
              </tr>
              @endforeach
              @endif
            </tbody>
        </table>
        <div class="columns">
          <div class="column">
          </br>
          <table class="is-centered custom_table"  style="border: 0px solid transparent;">
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
        <div class="column">
        </br>
        <table class="is-centered custom_table"  style="border: 0px solid transparent;">
          <tr>
            <th>Nunukan, 02 Januari {{$getdatas->assessment_year}}</th>
          </tr>
          <tr>
            <th>Pegawai Negeri Sipil Yang Dinilai</th>
          </tr>
            <tr>
                <td>
                    {!! QrCode::size(60)->generate($userqrcode); !!}
                </td>
            </tr>
            <tr>
                <td>
                    <u>({{$getdatas->personalData->name}})</u>
                </td>
            </tr>
            <tr>
                <td>
                    NIP. {{$getdatas->personalData->civil_servant_reg_number}}
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
