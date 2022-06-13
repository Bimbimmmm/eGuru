@extends('layouts.headoffice')
@section('content')
<div class="min-h-screen bg-gray-100 py-3">
  <div class="px-5 mx-auto max-w-7x1">
    <a href="/officehead/personaldata">
      <button class="block text-green-500 rounded-sm font-bold py-4 px-6 mr-2 flex items-center hover:bg-green-500 hover:text-white">
        <svg class="h-5 w-5 mr-2 fill-current" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="-49 141 512 512" style="enable-background:new -49 141 512 512;" xml:space="preserve">
          <path id="XMLID_10_" d="M438,372H36.355l72.822-72.822c9.763-9.763,9.763-25.592,0-35.355c-9.763-9.764-25.593-9.762-35.355,0 l-115.5,115.5C-46.366,384.01-49,390.369-49,397s2.634,12.989,7.322,17.678l115.5,115.5c9.763,9.762,25.593,9.763,35.355,0 c9.763-9.763,9.763-25.592,0-35.355L36.355,422H438c13.808,0,25-11.193,25-25S451.808,372,438,372z"></path>
        </svg>
      </button>
    </a>
    <h1 class="mb-12 text-center text-4xl text-gray-500 font-bold">Data Pribadi Bawahan</h1>
    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
      <div class="w-full overflow-x-auto">
        <table class="w-full">
          <tbody class="bg-white">
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">Nama Lengkap</td>
              <td class="px-4 py-3 text-ms border font-semibold">:</td>
              <td class="px-4 py-3 text-ms border">{{$data->name}}</td>
            </tr>
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">NIP</td>
              <td class="px-4 py-3 text-ms border font-semibold">:</td>
              <td class="px-4 py-3 text-ms border">{{$data->registration_number}}</td>
            </tr>
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">NIK</td>
              <td class="px-4 py-3 text-ms border font-semibold">:</td>
              <td class="px-4 py-3 text-ms border">{{$data->id_number}}</td>
            </tr>
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">NUPTK</td>
              <td class="px-4 py-3 text-ms border font-semibold">:</td>
              <td class="px-4 py-3 text-ms border">{{$data->educator_number}}</td>
            </tr>
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">Tempat, Tanggal Lahir</td>
              <td class="px-4 py-3 text-ms border font-semibold">:</td>
              <td class="px-4 py-3 text-ms border">{{$data->birth_place}}, {{$data->birth_date->isoFormat('DD MMMM Y')}}</td>
            </tr>
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">Jenis Kelamin</td>
              <td class="px-4 py-3 text-ms border font-semibold">:</td>
              <td class="px-4 py-3 text-ms border">{{$data->gender}}</td>
            </tr>
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">Status Perkawinan</td>
              <td class="px-4 py-3 text-ms border font-semibold">:</td>
              <td class="px-4 py-3 text-ms border">{{$data->maritalStatus->name}}</td>
            </tr>
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">Agama</td>
              <td class="px-4 py-3 text-ms border font-semibold">:</td>
              <td class="px-4 py-3 text-ms border">{{$data->religion->name}}</td>
            </tr>
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">Pangkat / Golongan</td>
              <td class="px-4 py-3 text-ms border font-semibold">:</td>
              <td class="px-4 py-3 text-ms border">{{$data->rank->rank}} / {{$data->rank->group}}</td>
            </tr>
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">Unit Kerja</td>
              <td class="px-4 py-3 text-ms border font-semibold">:</td>
              <td class="px-4 py-3 text-ms border">{{$data->workUnit->name}}</td>
            </tr>
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">Jabatan</td>
              <td class="px-4 py-3 text-ms border font-semibold">:</td>
              <td class="px-4 py-3 text-ms border">{{$data->position->name}}</td>
            </tr>
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">Status</td>
              <td class="px-4 py-3 text-ms border font-semibold">:</td>
              <td class="px-4 py-3 text-ms border">{{$data->status->name}}</td>
            </tr>
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">Pendidikan Terakhir</td>
              <td class="px-4 py-3 text-ms border font-semibold">:</td>
              <td class="px-4 py-3 text-ms border">{{$data->education->name}}</td>
            </tr>
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">T.M.T CPNS / T.M.T PNS</td>
              <td class="px-4 py-3 text-ms border font-semibold">:</td>
              <td class="px-4 py-3 text-ms border">{{$data->cs_candidate_year->isoFormat('DD MMMM Y')}} / {{$data->cs_year->isoFormat('DD MMMM Y')}}</td>
            </tr>
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">NPWP</td>
              <td class="px-4 py-3 text-ms border font-semibold">:</td>
              <td class="px-4 py-3 text-ms border">{{$data->tax_number}}</td>
            </tr>
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">Alamat Lengkap</td>
              <td class="px-4 py-3 text-ms border font-semibold">:</td>
              <td class="px-4 py-3 text-ms border">{{$data->address}}, {{$data->village}}, {{$data->district}}, {{$data->city}}, {{$data->province}}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <h1 class="text-left text-base text-black text-gray-900 font-bold">1. Pendidikan Formal</h1>
    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
      <div class="w-full overflow-x-auto">
        <table class="w-full">
          <thead>
            <tr class="text-md text-center font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
              <th class="px-4 py-3">No</th>
              <th class="px-4 py-3">Jenjang Pendidikan</th>
              <th class="px-4 py-3">Nama Sekolah</th>
              <th class="px-4 py-3">Tahun Lulus</th>
              <th class="px-4 py-3">Nomor Ijazah</th>
              <th class="px-4 py-3">File</th>
            </tr>
          </thead>
          <tbody class="bg-white">
              @foreach($fehdatas as $fehdata)
              <tr class="text-gray-700 text-center">
                <td class="px-4 py-3 text-ms border font-semibold">{{$loop->iteration}}</td>
                <td class="px-4 py-3 text-ms border">{{$fehdata->education_level}}</td>
                <td class="px-4 py-3 text-ms border">{{$fehdata->name}}</td>
                <td class="px-4 py-3 text-ms border">{{$fehdata->graduation_date->isoFormat('DD MMMM YYYY')}}</td>
                <td class="px-4 py-3 text-ms border">{{$fehdata->diploma_number}}</td>
                <td class="px-4 py-3 text-ms border">
                  <a class="underline text-blue-500" href="{{ asset('storage/datahistory/formaleducation/' . $fehdata->file) }}">{{$fehdata->file}}</a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

      <h1 class="text-left text-base text-black text-gray-900 font-bold">2. Pendidikan Non-Formal</h1>
      <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
        <div class="w-full overflow-x-auto">
          <table class="w-full">
            <thead>
              <tr class="text-md text-center font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                <th class="px-4 py-3">No</th>
                <th class="px-4 py-3">Nama Pelatihan / Pendidikan</th>
                <th class="px-4 py-3">Nama Lembaga Pelatihan / Pendidikan</th>
                <th class="px-4 py-3">Tahun Lulus</th>
                <th class="px-4 py-3">Nomor Sertifikat</th>
                <th class="px-4 py-3">File</th>
              </tr>
            </thead>
            <tbody class="bg-white">
              @foreach($nfehdatas as $nfehdata)
              <tr class="text-gray-700 text-center">
                <td class="px-4 py-3 text-ms border font-semibold">{{$loop->iteration}}</td>
                <td class="px-4 py-3 text-ms border">{{$nfehdata->name}}</td>
                <td class="px-4 py-3 text-ms border">{{$nfehdata->graduation_date->isoFormat('DD MMMM YYYY')}}</td>
                <td class="px-4 py-3 text-ms border">{{$nfehdata->place}}</td>
                <td class="px-4 py-3 text-ms border">{{$nfehdata->certificate_number}}</td>
                <td class="px-4 py-3 text-ms border">
                  <a class="underline text-blue-500" href="{{ asset('storage/datahistory/nonformaleducation/' . $nfehdata->file) }}">{{$nfehdata->file}}</a>
                </td>
              </tr>
              @endforeach
            </tbody>
            </table>
          </div>
        </div>

        <h1 class="text-left text-base text-black text-gray-900 font-bold">3. Riwayat Kepangkatan</h1>
        <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
          <div class="w-full overflow-x-auto">
            <table class="w-full">
              <thead>
                <tr class="text-md text-center font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                  <th class="px-4 py-3">No</th>
                  <th class="px-4 py-3">Pangkat</th>
                  <th class="px-4 py-3">Golongan</th>
                  <th class="px-4 py-3">T.M.T</th>
                  <th class="px-4 py-3">Nomor SK</th>
                  <th class="px-4 py-3">File</th>
                </tr>
              </thead>
              <tbody class="bg-white">
                @foreach($rhdatas as $rhdata)
                <tr class="text-gray-700 text-center">
                  <td class="px-4 py-3 text-ms border font-semibold">{{$loop->iteration}}</td>
                  <td class="px-4 py-3 text-ms border">{{$rhdata->last_rank}}</td>
                  <td class="px-4 py-3 text-ms border">{{$rhdata->last_group}}</td>
                  <td class="px-4 py-3 text-ms border">{{$rhdata->starting_from_date->isoFormat('DD MMMM YYYY')}}</td>
                  <td class="px-4 py-3 text-ms border">{{$rhdata->number_of_decree}}</td>
                  <td class="px-4 py-3 text-ms border">{{$rhdata->decree_date->isoFormat('DD MMMM YYYY')}}</td>
                  <td class="px-4 py-3 text-ms border">
                    <a class="underline text-blue-500" href="{{ asset('storage/datahistory/rank/' . $rhdata->file) }}">{{$rhdata->file}}</a>
                  </td>
                </tr>
                @endforeach
                </tbody>
              </table>
            </div>
          </div>

          <h1 class="text-left text-base text-black text-gray-900 font-bold">4. Riwayat Jabatan</h1>
          <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
            <div class="w-full overflow-x-auto">
              <table class="w-full">
                <thead>
                  <tr class="text-md text-center font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                    <th class="px-4 py-3">No</th>
                    <th class="px-4 py-3">Nama Jabatan</th>
                    <th class="px-4 py-3">Mulai - Sampai</th>
                    <th class="px-4 py-3">Jenis Jabatan</th>
                    <th class="px-4 py-3">T.M.T</th>
                    <th class="px-4 py-3">Nomor SK</th>
                    <th class="px-4 py-3">File</th>
                  </tr>
                </thead>
                <tbody class="bg-white">
                  @foreach($phdatas as $phdata)
                  <tr class="text-gray-700 text-center">
                    <td class="px-4 py-3 text-ms border font-semibold">{{$loop->iteration}}</td>
                    <td class="px-4 py-3 text-ms border">{{$phdata->position}}</td>
                    <td class="px-4 py-3 text-ms border">{{$phdata->start_date->isoFormat('DD MMMM YYYY')}} - {{$phdata->end_date->isoFormat('DD MMMM YYYY')}}</td>
                    <td class="px-4 py-3 text-ms border">{{$phdata->referencePosition->name}}</td>
                    <td class="px-4 py-3 text-ms border">{{$phdata->starting_from_date->isoFormat('DD MMMM YYYY')}}</td>
                    <td class="px-4 py-3 text-ms border">{{$phdata->number_of_decree}}</td>
                    <td class="px-4 py-3 text-ms border">
                      <a class="underline text-blue-500" href="{{ asset('storage/datahistory/position/' . $phdata->file) }}">{{$phdata->file}}</a>
                    </td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
            </div>

            <h1 class="text-left text-base text-black text-gray-900 font-bold">5. Riwayat Kenaikan Gaji Berkala</h1>
            <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
              <div class="w-full overflow-x-auto">
                <table class="w-full">
                  <thead>
                    <tr class="text-md text-center font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                      <th class="px-4 py-3">No</th>
                      <th class="px-4 py-3">Nomor SK Berkala</th>
                      <th class="px-4 py-3">T.M.T</th>
                      <th class="px-4 py-3">Pangkat / Golongan</th>
                      <th class="px-4 py-3">Gaji Pokok Lama</th>
                      <th class="px-4 py-3">Gaji Pokok Baru</th>
                      <th class="px-4 py-3">File</th>
                    </tr>
                  </thead>
                  <tbody class="bg-white">
                    @foreach($sihdatas as $sihdata)
                    <tr class="text-gray-700 text-center">
                      <td class="px-4 py-3 text-ms border font-semibold">{{$loop->iteration}}</td>
                      <td class="px-4 py-3 text-ms border">{{$sihdata->number_of_decree}}</td>
                      <td class="px-4 py-3 text-ms border">{{$sihdata->starting_from_date->isoFormat('DD MMMM YYYY')}}</td>
                      <td class="px-4 py-3 text-ms border">{{$sihdata->last_rank}}</td>
                      <td class="px-4 py-3 text-ms border">{{$sihdata->last_salary}}</td>
                      <td class="px-4 py-3 text-ms border">{{$sihdata->new_salary}}</td>
                      <td class="px-4 py-3 text-ms border">
                        <a class="underline text-blue-500" href="{{ asset('storage/datahistory/salaryincrease/' . $sihdata->file) }}">{{$sihdata->file}}</a>
                      </td>
                    </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>
              </div>

              <h1 class="text-left text-base text-black text-gray-900 font-bold">6. Riwayat Penghargaan</h1>
              <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
                <div class="w-full overflow-x-auto">
                  <table class="w-full">
                    <thead>
                      <tr class="text-md text-center font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                        <th class="px-4 py-3">No</th>
                        <th class="px-4 py-3">Nama Penghargaan</th>
                        <th class="px-4 py-3">Tahun</th>
                        <th class="px-4 py-3">Nama Instansi Pemberi Penghargaan</th>
                        <th class="px-4 py-3">File</th>
                      </tr>
                    </thead>
                    <tbody class="bg-white">
                      @foreach($ahdatas as $ahdata)
                      <tr class="text-gray-700 text-center">
                        <td class="px-4 py-3 text-ms border font-semibold">{{$loop->iteration}}</td>
                        <td class="px-4 py-3 text-ms border">{{$ahdata->name}}</td>
                        <td class="px-4 py-3 text-ms border">{{$ahdata->year}}</td>
                        <td class="px-4 py-3 text-ms border">{{$ahdata->issued_by}}</td>
                        <td class="px-4 py-3 text-ms border">
                          <a class="underline text-blue-500" href="{{ asset('storage/datahistory/appreciation/' . $ahdata->file) }}">{{$ahdata->file}}</a>
                        </td>
                      </tr>
                      @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            @endsection
