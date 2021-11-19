<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ReferenceActivityCreditScoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      \DB::table('reference_activity_credit_score')->insert([
          [
              'element' => 'Unsur Utama',
              'sub_element' => 'PENDIDIKAN',
              'activity_item' => 'Mengikuti pendidikan dan memperoleh gelar/ijazah/akta',
              'grain_item' => 'Doktor (S-3)',
              'sub_grain_item' => null,
              'code' => 1,
              'output' => 'Ijazah',
              'credit_score' => 200.00,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Utama',
              'sub_element' => 'PENDIDIKAN',
              'activity_item' => 'Mengikuti pendidikan dan memperoleh gelar/ijazah/akta',
              'grain_item' => 'Magister (S-2)',
              'sub_grain_item' => null,
              'code' => 2,
              'output' => 'Ijazah',
              'credit_score' => 150.00,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Utama',
              'sub_element' => 'PENDIDIKAN',
              'activity_item' => 'Mengikuti pendidikan dan memperoleh gelar/ijazah/akta',
              'grain_item' => 'Sarjana (S-1)/Diploma IV',
              'sub_grain_item' => null,
              'code' => 3,
              'output' => 'Ijazah',
              'credit_score' => 100.00,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Utama',
              'sub_element' => 'PENDIDIKAN',
              'activity_item' => 'Mengikuti pelatihan prajabatan',
              'grain_item' => 'Pelatihan prajabatan fungsional bagi guru calon pegawai negeri sipil/program induksi',
              'sub_grain_item' => null,
              'code' => 4,
              'output' => 'STPPL',
              'credit_score' => 3.00,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Utama',
              'sub_element' => 'PEMBELAJARAN/BIMBINGAN DAN TUGAS TERTENTU',
              'activity_item' => 'Melaksanakan proses pembelajaran',
              'grain_item' => 'Merencanakan dan melaksanakan pembelajaran, mengevaluasi dan menilai hasil pembelajaran, menganalisis hasil pembelajaran, melaksanakan tindak lanjut hasil penilaian',
              'sub_grain_item' => null,
              'code' => 5,
              'output' => 'Laporan Penilaian Kinerja',
              'credit_score' => null,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Utama',
              'sub_element' => 'PEMBELAJARAN/BIMBINGAN DAN TUGAS TERTENTU',
              'activity_item' => 'Melaksanakan proses bimbingan',
              'grain_item' => 'Merencanakan dan melaksanakan bimbingan, mengevaluasi dan menilai hasil bimbingan, menganalisis hasil bimbingan, melaksanakan tindak lanjut hasil pembimbingan',
              'sub_grain_item' => null,
              'code' => 6,
              'output' => 'Laporan Penilaian Kinerja',
              'credit_score' => null,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Utama',
              'sub_element' => 'PEMBELAJARAN/BIMBINGAN DAN TUGAS TERTENTU',
              'activity_item' => 'Melaksanakan tugas lain yang relevan dengan fungsi sekolah',
              'grain_item' => 'Menjadi Kepala Sekolah per tahun',
              'sub_grain_item' => null,
              'code' => 7,
              'output' => 'Laporan Penilaian Kinerja',
              'credit_score' => null,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Utama',
              'sub_element' => 'PEMBELAJARAN/BIMBINGAN DAN TUGAS TERTENTU',
              'activity_item' => 'Melaksanakan tugas lain yang relevan dengan fungsi sekolah',
              'grain_item' => 'Menjadi Wakil Kepala Sekolah per tahun',
              'sub_grain_item' => null,
              'code' => 8,
              'output' => 'Laporan Penilaian Kinerja',
              'credit_score' => null,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Utama',
              'sub_element' => 'PEMBELAJARAN/BIMBINGAN DAN TUGAS TERTENTU',
              'activity_item' => 'Melaksanakan tugas lain yang relevan dengan fungsi sekolah',
              'grain_item' => 'Menjadi Ketua program keahlian/program studi atau yang sejenisnya',
              'sub_grain_item' => null,
              'code' => 9,
              'output' => 'Laporan Penilaian Kinerja',
              'credit_score' => null,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Utama',
              'sub_element' => 'PEMBELAJARAN/BIMBINGAN DAN TUGAS TERTENTU',
              'activity_item' => 'Melaksanakan tugas lain yang relevan dengan fungsi sekolah',
              'grain_item' => 'Menjadi Kepala perpustakaan',
              'sub_grain_item' => null,
              'code' => 10,
              'output' => 'Laporan Penilaian Kinerja',
              'credit_score' => null,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Utama',
              'sub_element' => 'PEMBELAJARAN/BIMBINGAN DAN TUGAS TERTENTU',
              'activity_item' => 'Melaksanakan tugas lain yang relevan dengan fungsi sekolah',
              'grain_item' => 'Menjadi Kepala laboratorium, bengkel unit produksi atau yang sejenisnya',
              'sub_grain_item' => null,
              'code' => 11,
              'output' => 'Laporan Penilaian Kinerja',
              'credit_score' => null,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Utama',
              'sub_element' => 'PEMBELAJARAN/BIMBINGAN DAN TUGAS TERTENTU',
              'activity_item' => 'Melaksanakan tugas lain yang relevan dengan fungsi sekolah',
              'grain_item' => 'Menjadi Pembimbing khusus pada satuan pendidikan yang menyelenggarakan pendidikan inklusi, pendidikan terpadu atau sejenisnya',
              'sub_grain_item' => null,
              'code' => 12,
              'output' => 'Laporan Penilaian Kinerja',
              'credit_score' => null,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Utama',
              'sub_element' => 'PEMBELAJARAN/BIMBINGAN DAN TUGAS TERTENTU',
              'activity_item' => 'Melaksanakan tugas lain yang relevan dengan fungsi sekolah',
              'grain_item' => 'Menjadi Wali kelas',
              'sub_grain_item' => null,
              'code' => 13,
              'output' => 'Laporan Penilaian Kinerja',
              'credit_score' => null,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Utama',
              'sub_element' => 'PEMBELAJARAN/BIMBINGAN DAN TUGAS TERTENTU',
              'activity_item' => 'Melaksanakan tugas lain yang relevan dengan fungsi sekolah',
              'grain_item' => 'Menyusun kurikulum pada satuan pendidikannya',
              'sub_grain_item' => null,
              'code' => 14,
              'output' => 'Laporan Penilaian Kinerja',
              'credit_score' => null,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Utama',
              'sub_element' => 'PEMBELAJARAN/BIMBINGAN DAN TUGAS TERTENTU',
              'activity_item' => 'Melaksanakan tugas lain yang relevan dengan fungsi sekolah',
              'grain_item' => 'Menjadi pengawas penilaian dan evaluasi terhadap proses dan hasil belajar',
              'sub_grain_item' => null,
              'code' => 15,
              'output' => 'Laporan Penilaian Kinerja',
              'credit_score' => null,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Utama',
              'sub_element' => 'PEMBELAJARAN/BIMBINGAN DAN TUGAS TERTENTU',
              'activity_item' => 'Melaksanakan tugas lain yang relevan dengan fungsi sekolah',
              'grain_item' => 'Membimbing guru pemula dalam program induksi',
              'sub_grain_item' => null,
              'code' => 15,
              'output' => 'Laporan Penilaian Kinerja',
              'credit_score' => null,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Utama',
              'sub_element' => 'PEMBELAJARAN/BIMBINGAN DAN TUGAS TERTENTU',
              'activity_item' => 'Melaksanakan tugas lain yang relevan dengan fungsi sekolah',
              'grain_item' => 'Membimbing siswa dalam kegiatan ekstrakurikuler',
              'sub_grain_item' => null,
              'code' => 16,
              'output' => 'Laporan Penilaian Kinerja',
              'credit_score' => null,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Utama',
              'sub_element' => 'PEMBELAJARAN/BIMBINGAN DAN TUGAS TERTENTU',
              'activity_item' => 'Melaksanakan tugas lain yang relevan dengan fungsi sekolah',
              'grain_item' => 'Menjadi pembimbing pada penyusunan publikasi ilmiah dan karya inovatif',
              'sub_grain_item' => null,
              'code' => 17,
              'output' => 'Laporan Penilaian Kinerja',
              'credit_score' => null,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Utama',
              'sub_element' => 'PEMBELAJARAN/BIMBINGAN DAN TUGAS TERTENTU',
              'activity_item' => 'Melaksanakan tugas lain yang relevan dengan fungsi sekolah',
              'grain_item' => 'Melaksanakan pembimbingan pada kelas yang menjadi tenggungjawabnya (Khusus Guru Kelas)',
              'sub_grain_item' => null,
              'code' => 18,
              'output' => 'Laporan Penilaian Kinerja',
              'credit_score' => null,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Utama',
              'sub_element' => 'PENGEMBANGAN KEPROFESIAN BERKELANJUTAN',
              'activity_item' => 'Melaksanakan pengembangan diri',
              'grain_item' => 'Mengikuti diklat fungsional',
              'sub_grain_item' => 'Lamanya lebih dari 960 jam',
              'code' => 19,
              'output' => '1.  Surat Tugas 2.  Laporan Deskirpsi hasil pelatihan 3.  Sertifikat',
              'credit_score' => 15.00,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Utama',
              'sub_element' => 'PENGEMBANGAN KEPROFESIAN BERKELANJUTAN',
              'activity_item' => 'Melaksanakan pengembangan diri',
              'grain_item' => 'Mengikuti diklat fungsional',
              'sub_grain_item' => 'Lamanya antara 641 s.d. 960 jam',
              'code' => 20,
              'output' => '1.  Surat Tugas 2.  Laporan Deskirpsi hasil pelatihan 3.  Sertifikat',
              'credit_score' => 9.00,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Utama',
              'sub_element' => 'PENGEMBANGAN KEPROFESIAN BERKELANJUTAN',
              'activity_item' => 'Melaksanakan pengembangan diri',
              'grain_item' => 'Mengikuti diklat fungsional',
              'sub_grain_item' => 'Lamanya antara 481 s.d. 640 jam',
              'code' => 21,
              'output' => '1.  Surat Tugas 2.  Laporan Deskirpsi hasil pelatihan 3.  Sertifikat',
              'credit_score' => 6.00,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Utama',
              'sub_element' => 'PENGEMBANGAN KEPROFESIAN BERKELANJUTAN',
              'activity_item' => 'Melaksanakan pengembangan diri',
              'grain_item' => 'Mengikuti diklat fungsional',
              'sub_grain_item' => 'Lamanya antara 181 s.d. 480 jam',
              'code' => 22,
              'output' => '1.  Surat Tugas 2.  Laporan Deskirpsi hasil pelatihan 3.  Sertifikat',
              'credit_score' => 3.00,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Utama',
              'sub_element' => 'PENGEMBANGAN KEPROFESIAN BERKELANJUTAN',
              'activity_item' => 'Melaksanakan pengembangan diri',
              'grain_item' => 'Mengikuti diklat fungsional',
              'sub_grain_item' => 'Lamanya antara 81 s.d. 180 jam',
              'code' => 23,
              'output' => '1.  Surat Tugas 2.  Laporan Deskirpsi hasil pelatihan 3.  Sertifikat',
              'credit_score' => 2.00,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Utama',
              'sub_element' => 'PENGEMBANGAN KEPROFESIAN BERKELANJUTAN',
              'activity_item' => 'Melaksanakan pengembangan diri',
              'grain_item' => 'Mengikuti diklat fungsional',
              'sub_grain_item' => 'Lamanya antara 30 s.d. 80 jam',
              'code' => 24,
              'output' => '1.  Surat Tugas 2.  Laporan Deskirpsi hasil pelatihan 3.  Sertifikat',
              'credit_score' => 1.00,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Utama',
              'sub_element' => 'PENGEMBANGAN KEPROFESIAN BERKELANJUTAN',
              'activity_item' => 'Melaksanakan pengembangan diri',
              'grain_item' => 'Kegiatan kolektif guru yang meningkatkan kompetensi dan/atau keprofesian guru',
              'sub_grain_item' => 'Lokakarya atau kegiatan bersama (seperti kelompok kerja guru) untuk penyempurnaan perangkat kurikulum dan atau diskusi panel',
              'code' => 25,
              'output' => 'Surat Keterangan dan laporan per kegiatan',
              'credit_score' => 0.15,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Utama',
              'sub_element' => 'PENGEMBANGAN KEPROFESIAN BERKELANJUTAN',
              'activity_item' => 'Melaksanakan pengembangan diri',
              'grain_item' => 'Kegiatan kolektif guru yang meningkatkan kompetensi dan/atau keprofesian guru',
              'sub_grain_item' => 'Keikutsertaan pada kegiatan ilmiah (seminar, kologium dan diskusi panel) / Menjadi pembahas pada kegiatan ilmiah',
              'code' => 26,
              'output' => 'Surat Keterangan dan laporan per kegiatan',
              'credit_score' => 0.2,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Utama',
              'sub_element' => 'PENGEMBANGAN KEPROFESIAN BERKELANJUTAN',
              'activity_item' => 'Melaksanakan pengembangan diri',
              'grain_item' => 'Kegiatan kolektif guru yang meningkatkan kompetensi dan/atau keprofesian guru',
              'sub_grain_item' => 'Keikutsertaan pada kegiatan ilmiah (seminar, kologium dan diskusi panel) / Menjadi peserta pada kegiatan ilmiah',
              'code' => 27,
              'output' => 'Surat Keterangan dan laporan per kegiatan',
              'credit_score' => 0.1,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Utama',
              'sub_element' => 'PENGEMBANGAN KEPROFESIAN BERKELANJUTAN',
              'activity_item' => 'Melaksanakan pengembangan diri',
              'grain_item' => 'Kegiatan kolektif guru yang meningkatkan kompetensi dan/atau keprofesian guru',
              'sub_grain_item' => 'Kegiatan kolektif lainnya yang sesuai dengan tugas dan kewajiban guru',
              'code' => 28,
              'output' => 'Surat Keterangan dan laporan per kegiatan',
              'credit_score' => 0.1,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Utama',
              'sub_element' => 'PENGEMBANGAN KEPROFESIAN BERKELANJUTAN',
              'activity_item' => 'Melaksanakan publikasi ilmiah',
              'grain_item' => 'Presentasi pada forum ilmiah',
              'sub_grain_item' => 'Menjadi pemrasaran/nara sumber pada seminar atau lokakarya ilmiah',
              'code' => 29,
              'output' => 'Surat Keterangan dan laporan per kegiatan',
              'credit_score' => 0.2,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Utama',
              'sub_element' => 'PENGEMBANGAN KEPROFESIAN BERKELANJUTAN',
              'activity_item' => 'Melaksanakan publikasi ilmiah',
              'grain_item' => 'Presentasi pada forum ilmiah',
              'sub_grain_item' => 'Menjadi pemrasaran/nara sumber pada koloqium atau diskusi ilmiah',
              'code' => 30,
              'output' => 'Surat Keterangan dan laporan per kegiatan',
              'credit_score' => 0.2,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Utama',
              'sub_element' => 'PENGEMBANGAN KEPROFESIAN BERKELANJUTAN',
              'activity_item' => 'Melaksanakan publikasi ilmiah',
              'grain_item' => 'Melaksanakan publikasi ilmiah hasil penelitian atau gagasan ilmu pada bidang pendidikan formal',
              'sub_grain_item' => 'Membuat karya tulis berupa laporan hasil penelitian pada bidang pendidikan di sekolah, diterbitkan/dipublikasikan dalam bentuk buku ber ISBN dan diedarkan secara nasional atau telah lulus dari penilaian BNSP',
              'code' => 31,
              'output' => 'Buku',
              'credit_score' => 4.00,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Utama',
              'sub_element' => 'PENGEMBANGAN KEPROFESIAN BERKELANJUTAN',
              'activity_item' => 'Melaksanakan publikasi ilmiah',
              'grain_item' => 'Melaksanakan publikasi ilmiah hasil penelitian atau gagasan ilmu pada bidang pendidikan formal',
              'sub_grain_item' => 'Membuat karya tulis berupa laporan hasil penelitian pada bidang pendidikan di sekolah, diterbitkan/dipublikasikan dalam majalah/jurnal lmiah tingkat nasional yang terakreditasi',
              'code' => 32,
              'output' => 'Karya tulis dalam majalah / jurnal ilmiah',
              'credit_score' => 3.00,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Utama',
              'sub_element' => 'PENGEMBANGAN KEPROFESIAN BERKELANJUTAN',
              'activity_item' => 'Melaksanakan publikasi ilmiah',
              'grain_item' => 'Melaksanakan publikasi ilmiah hasil penelitian atau gagasan ilmu pada bidang pendidikan formal',
              'sub_grain_item' => 'Membuat karya tulis berupa laporan hasil penelitian pada bidang pendidikan di sekolah, diterbitkan/dipublikasikan dalam majalah/jurnal ilmiah tingkat provinsi',
              'code' => 33,
              'output' => 'Karya tulis dalam majalah / jurnal ilmiah',
              'credit_score' => 2.00,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Utama',
              'sub_element' => 'PENGEMBANGAN KEPROFESIAN BERKELANJUTAN',
              'activity_item' => 'Melaksanakan publikasi ilmiah',
              'grain_item' => 'Melaksanakan publikasi ilmiah hasil penelitian atau gagasan ilmu pada bidang pendidikan formal',
              'sub_grain_item' => 'Membuat karya tulis berupa laporan hasil penelitian pada bidang pendidikan di sekolah, diterbitkan/dipublikasikan dalam majalah/jurnal ilmiah tingkat kabupaten/Kota',
              'code' => 34,
              'output' => 'Karya tulis dalam majalah / jurnal ilmiah',
              'credit_score' => 1.00,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Utama',
              'sub_element' => 'PENGEMBANGAN KEPROFESIAN BERKELANJUTAN',
              'activity_item' => 'Melaksanakan publikasi ilmiah',
              'grain_item' => 'Melaksanakan publikasi ilmiah hasil penelitian atau gagasan ilmu pada bidang pendidikan formal',
              'sub_grain_item' => 'Membuat karya tulis berupa laporan hasil penelitian pada bidang pendidikan di sekolah, diseminarkan di sekolah, disimpan di perpustakaan',
              'code' => 35,
              'output' => 'Laporan',
              'credit_score' => 4.00,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Utama',
              'sub_element' => 'PENGEMBANGAN KEPROFESIAN BERKELANJUTAN',
              'activity_item' => 'Melaksanakan publikasi ilmiah',
              'grain_item' => 'Melaksanakan publikasi ilmiah hasil penelitian atau gagasan ilmu pada bidang pendidikan formal',
              'sub_grain_item' => 'Membuat makalah berupa tinjauan ilmiah dalam bidang pendidikan formal dan pembelajaran pada satuan pendidikan, tidak diterbitkan, disimpan di perpustakaan',
              'code' => 36,
              'output' => 'Makalah',
              'credit_score' => 2.00,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Utama',
              'sub_element' => 'PENGEMBANGAN KEPROFESIAN BERKELANJUTAN',
              'activity_item' => 'Melaksanakan publikasi ilmiah',
              'grain_item' => 'Melaksanakan publikasi ilmiah hasil penelitian atau gagasan ilmu pada bidang pendidikan formal',
              'sub_grain_item' => 'Membuat Artikel Ilmiah Populer di bidang pendidikan formal dan pembelajaran pada satuan pendidikan dimuat di media massa tingkat nasional',
              'code' => 37,
              'output' => 'Artikel Ilmiah',
              'credit_score' => 2.00,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Utama',
              'sub_element' => 'PENGEMBANGAN KEPROFESIAN BERKELANJUTAN',
              'activity_item' => 'Melaksanakan publikasi ilmiah',
              'grain_item' => 'Melaksanakan publikasi ilmiah hasil penelitian atau gagasan ilmu pada bidang pendidikan formal',
              'sub_grain_item' => 'Membuat Artikel Ilmiah Populer di bidang pendidikan formal dan pembelajaran pada satuan pendidikan dimuat di media massa tingkat provinsi (koran daerah)',
              'code' => 38,
              'output' => 'Artikel Ilmiah',
              'credit_score' => 1.50,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Utama',
              'sub_element' => 'PENGEMBANGAN KEPROFESIAN BERKELANJUTAN',
              'activity_item' => 'Melaksanakan publikasi ilmiah',
              'grain_item' => 'Melaksanakan publikasi ilmiah hasil penelitian atau gagasan ilmu pada bidang pendidikan formal',
              'sub_grain_item' => 'Membuat Artikel Ilmiah dalam bidang pendidikan formal dan pembelajaran pada satuan pendidikan dan dimuat di jurnal tingkat nasional yang terakreditasi',
              'code' => 39,
              'output' => 'Artikel Ilmiah',
              'credit_score' => 2.00,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Utama',
              'sub_element' => 'PENGEMBANGAN KEPROFESIAN BERKELANJUTAN',
              'activity_item' => 'Melaksanakan publikasi ilmiah',
              'grain_item' => 'Melaksanakan publikasi ilmiah hasil penelitian atau gagasan ilmu pada bidang pendidikan formal',
              'sub_grain_item' => 'Membuat Artikel Ilmiah dalam bidang pendidikan formal dan pembelajaran pada satuan pendidikan dan dimuat di jurnal tingkat nasional yang tidak terakreditasi /tingkat provinsi',
              'code' => 40,
              'output' => 'Artikel Ilmiah',
              'credit_score' => 1.50,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Utama',
              'sub_element' => 'PENGEMBANGAN KEPROFESIAN BERKELANJUTAN',
              'activity_item' => 'Melaksanakan publikasi ilmiah',
              'grain_item' => 'Melaksanakan publikasi ilmiah hasil penelitian atau gagasan ilmu pada bidang pendidikan formal',
              'sub_grain_item' => 'Membuat Artikel Ilmiah dalam bidang pendidikan formal dan pembelajaran pada satuan pendidikan dan dimuat di jurnal tingkat lokal (kabupaten/kota/sekolah dst)',
              'code' => 41,
              'output' => 'Artikel Ilmiah',
              'credit_score' => 1.00,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Utama',
              'sub_element' => 'PENGEMBANGAN KEPROFESIAN BERKELANJUTAN',
              'activity_item' => 'Melaksanakan publikasi ilmiah',
              'grain_item' => 'Melaksanakan publikasi buku teks pelajaran, buku pengayaan, dan pedoman Guru',
              'sub_grain_item' => 'Membuat buku pelajaran per tingkat /buku pendidikan pe judul: Buku pelajaran yang lolos penilaian oleh BNSP',
              'code' => 42,
              'output' => 'Buku',
              'credit_score' => 6.00,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Utama',
              'sub_element' => 'PENGEMBANGAN KEPROFESIAN BERKELANJUTAN',
              'activity_item' => 'Melaksanakan publikasi ilmiah',
              'grain_item' => 'Melaksanakan publikasi buku teks pelajaran, buku pengayaan, dan pedoman Guru',
              'sub_grain_item' => 'Membuat buku pelajaran per tingkat /buku pendidikan pe judul: Buku pelajaran yang dicetak oleh penerbit dan ber ISBN',
              'code' => 43,
              'output' => 'Buku',
              'credit_score' => 3.00,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Utama',
              'sub_element' => 'PENGEMBANGAN KEPROFESIAN BERKELANJUTAN',
              'activity_item' => 'Melaksanakan publikasi ilmiah',
              'grain_item' => 'Melaksanakan publikasi buku teks pelajaran, buku pengayaan, dan pedoman Guru',
              'sub_grain_item' => 'Membuat buku pelajaran per tingkat /buku pendidikan pe judul: Buku pelajaran yang dicetak oleh penerbit tetapi belum ber ISBN',
              'code' => 44,
              'output' => 'Buku',
              'credit_score' => 1.00,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Utama',
              'sub_element' => 'PENGEMBANGAN KEPROFESIAN BERKELANJUTAN',
              'activity_item' => 'Melaksanakan publikasi ilmiah',
              'grain_item' => 'Melaksanakan publikasi buku teks pelajaran, buku pengayaan, dan pedoman Guru',
              'sub_grain_item' => 'Membuat modul/diklat pembelajaran per semester Digunakan di tingkat Provinsi dengan pengesahan dari Dinas Pendidikan Provinsi',
              'code' => 45,
              'output' => 'Modul / diktat',
              'credit_score' => 1.50,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Utama',
              'sub_element' => 'PENGEMBANGAN KEPROFESIAN BERKELANJUTAN',
              'activity_item' => 'Melaksanakan publikasi ilmiah',
              'grain_item' => 'Melaksanakan publikasi buku teks pelajaran, buku pengayaan, dan pedoman Guru',
              'sub_grain_item' => 'Membuat modul/diklat pembelajaran per semester Digunakan di tingkat kota/kabupaten dengan pengesahan dari Dinas Pendidikan kota/kabupaten',
              'code' => 46,
              'output' => 'Modul / diktat',
              'credit_score' => 1.00,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Utama',
              'sub_element' => 'PENGEMBANGAN KEPROFESIAN BERKELANJUTAN',
              'activity_item' => 'Melaksanakan publikasi ilmiah',
              'grain_item' => 'Melaksanakan publikasi buku teks pelajaran, buku pengayaan, dan pedoman Guru',
              'sub_grain_item' => 'Membuat modul/diklat pembelajaran per semester Digunakan di tingkat sekolah setempat',
              'code' => 47,
              'output' => 'Modul / diktat',
              'credit_score' => 0.50,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Utama',
              'sub_element' => 'PENGEMBANGAN KEPROFESIAN BERKELANJUTAN',
              'activity_item' => 'Melaksanakan publikasi ilmiah',
              'grain_item' => 'Melaksanakan publikasi buku teks pelajaran, buku pengayaan, dan pedoman Guru',
              'sub_grain_item' => 'Membuat Buku dalam bidang pendidikan dicetak oleh penerbit ber ISBN',
              'code' => 48,
              'output' => 'Buku',
              'credit_score' => 3.00,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Utama',
              'sub_element' => 'PENGEMBANGAN KEPROFESIAN BERKELANJUTAN',
              'activity_item' => 'Melaksanakan publikasi ilmiah',
              'grain_item' => 'Melaksanakan publikasi buku teks pelajaran, buku pengayaan, dan pedoman Guru',
              'sub_grain_item' => 'Membuat Buku dalam bidang pendidikan dicetak oleh penerbit tetapi berlum ber ISBN',
              'code' => 49,
              'output' => 'Buku',
              'credit_score' => 1.50,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Utama',
              'sub_element' => 'PENGEMBANGAN KEPROFESIAN BERKELANJUTAN',
              'activity_item' => 'Melaksanakan publikasi ilmiah',
              'grain_item' => 'Melaksanakan publikasi buku teks pelajaran, buku pengayaan, dan pedoman Guru',
              'sub_grain_item' => 'Membuat karya hasil terjemahan yang dinyatakan oleh kepala sekolah tiap karya',
              'code' => 50,
              'output' => 'Karya Hasil Terjemahan',
              'credit_score' => 1.00,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Utama',
              'sub_element' => 'PENGEMBANGAN KEPROFESIAN BERKELANJUTAN',
              'activity_item' => 'Melaksanakan publikasi ilmiah',
              'grain_item' => 'Melaksanakan publikasi buku teks pelajaran, buku pengayaan, dan pedoman Guru',
              'sub_grain_item' => 'Membuat buku pedoman guru',
              'code' => 51,
              'output' => 'Buku',
              'credit_score' => 1.50,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Utama',
              'sub_element' => 'PENGEMBANGAN KEPROFESIAN BERKELANJUTAN',
              'activity_item' => 'Melaksanakan karya inovatif',
              'grain_item' => 'Menemukan teknologi tepatguna',
              'sub_grain_item' => 'Kategori kompleks',
              'code' => 52,
              'output' => 'Hasil Karya',
              'credit_score' => 4.00,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Utama',
              'sub_element' => 'PENGEMBANGAN KEPROFESIAN BERKELANJUTAN',
              'activity_item' => 'Melaksanakan karya inovatif',
              'grain_item' => 'Menemukan teknologi tepatguna',
              'sub_grain_item' => 'Kategori sederhana',
              'code' => 53,
              'output' => 'Hasil Karya',
              'credit_score' => 2.00,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Utama',
              'sub_element' => 'PENGEMBANGAN KEPROFESIAN BERKELANJUTAN',
              'activity_item' => 'Melaksanakan karya inovatif',
              'grain_item' => 'Menemukan  / menciptakan karya seni',
              'sub_grain_item' => 'Kategori kompleks',
              'code' => 54,
              'output' => 'Hasil Karya',
              'credit_score' => 4.00,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Utama',
              'sub_element' => 'PENGEMBANGAN KEPROFESIAN BERKELANJUTAN',
              'activity_item' => 'Melaksanakan karya inovatif',
              'grain_item' => 'Menemukan  / menciptakan karya seni',
              'sub_grain_item' => 'Kategori sederhana',
              'code' => 55,
              'output' => 'Hasil Karya',
              'credit_score' => 2.00,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Utama',
              'sub_element' => 'PENGEMBANGAN KEPROFESIAN BERKELANJUTAN',
              'activity_item' => 'Melaksanakan karya inovatif',
              'grain_item' => 'Membuat/memodifikasi alat pelajaran/peraga/praktikum:',
              'sub_grain_item' => 'Membuat alat pelajaran: Kategori kompleks',
              'code' => 56,
              'output' => 'Alat Pelajaran',
              'credit_score' => 2.00,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Utama',
              'sub_element' => 'PENGEMBANGAN KEPROFESIAN BERKELANJUTAN',
              'activity_item' => 'Melaksanakan karya inovatif',
              'grain_item' => 'Membuat/memodifikasi alat pelajaran/peraga/praktikum:',
              'sub_grain_item' => 'Membuat alat pelajaran: Kategori Sederhana',
              'code' => 57,
              'output' => 'Alat Pelajaran',
              'credit_score' => 1.00,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Utama',
              'sub_element' => 'PENGEMBANGAN KEPROFESIAN BERKELANJUTAN',
              'activity_item' => 'Melaksanakan karya inovatif',
              'grain_item' => 'Membuat/memodifikasi alat pelajaran/peraga/praktikum:',
              'sub_grain_item' => 'Membuat alat peraga: Kategori kompleks ',
              'code' => 58,
              'output' => 'Alat Pelajaran',
              'credit_score' => 2.00,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Utama',
              'sub_element' => 'PENGEMBANGAN KEPROFESIAN BERKELANJUTAN',
              'activity_item' => 'Melaksanakan karya inovatif',
              'grain_item' => 'Membuat/memodifikasi alat pelajaran/peraga/praktikum:',
              'sub_grain_item' => 'Membuat alat peraga: Kategori Sederhana',
              'code' => 59,
              'output' => 'Alat Pelajaran',
              'credit_score' => 1.00,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Utama',
              'sub_element' => 'PENGEMBANGAN KEPROFESIAN BERKELANJUTAN',
              'activity_item' => 'Melaksanakan karya inovatif',
              'grain_item' => 'Membuat/memodifikasi alat pelajaran/peraga/praktikum:',
              'sub_grain_item' => 'Membuat alat praktikum: Kategori kompleks',
              'code' => 60,
              'output' => 'Alat Praktik',
              'credit_score' => 4.00,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Utama',
              'sub_element' => 'PENGEMBANGAN KEPROFESIAN BERKELANJUTAN',
              'activity_item' => 'Melaksanakan karya inovatif',
              'grain_item' => 'Membuat/memodifikasi alat pelajaran/peraga/praktikum:',
              'sub_grain_item' => 'Membuat alat praktikum: Kategori Sederhana',
              'code' => 61,
              'output' => 'Alat Praktik',
              'credit_score' => 2.00,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Utama',
              'sub_element' => 'PENGEMBANGAN KEPROFESIAN BERKELANJUTAN',
              'activity_item' => 'Melaksanakan karya inovatif',
              'grain_item' => 'Mengikuti Pengembangan Penyusunan Standar, Pedoman, Soal dan sejenisnya',
              'sub_grain_item' => 'Mengikuti kegiatan Penyusunan Standar/Pedoman/Soal dan sejenisnya pada tingkat nasional',
              'code' => 62,
              'output' => 'SK',
              'credit_score' => 1.00,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Utama',
              'sub_element' => 'PENGEMBANGAN KEPROFESIAN BERKELANJUTAN',
              'activity_item' => 'Melaksanakan karya inovatif',
              'grain_item' => 'Membuat/memodifikasi alat pelajaran/peraga/praktikum:',
              'sub_grain_item' => 'Mengikuti kegiatan Penyusunan Standar/Pedoman/Soal dan sejenisnya pada tingkat provinsi',
              'code' => 63,
              'output' => 'SK',
              'credit_score' => 1.00,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Penunjang',
              'sub_element' => 'PENUNJANG TUGAS GURU',
              'activity_item' => 'Memperoleh gelar/ijazah yang tidak sesuai dengan bidang yang diampuhnya',
              'grain_item' => 'Memperoleh gelar/ijazah yang tidak sesuai dengan bidang yang diampuhnya:',
              'sub_grain_item' => 'Doktor (S-3)',
              'code' => 64,
              'output' => 'Ijazah',
              'credit_score' => 15.00,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Penunjang',
              'sub_element' => 'PENUNJANG TUGAS GURU',
              'activity_item' => 'Memperoleh gelar/ijazah yang tidak sesuai dengan bidang yang diampuhnya',
              'grain_item' => 'Memperoleh gelar/ijazah yang tidak sesuai dengan bidang yang diampuhnya:',
              'sub_grain_item' => 'Pascasarjana (S-2)',
              'code' => 65,
              'output' => 'Ijazah',
              'credit_score' => 10.00,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Penunjang',
              'sub_element' => 'PENUNJANG TUGAS GURU',
              'activity_item' => 'Memperoleh gelar/ijazah yang tidak sesuai dengan bidang yang diampuhnya',
              'grain_item' => 'Memperoleh gelar/ijazah yang tidak sesuai dengan bidang yang diampuhnya:',
              'sub_grain_item' => 'Sarjana (S-1)/Diploma IV',
              'code' => 66,
              'output' => 'Ijazah',
              'credit_score' => 5.00,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Penunjang',
              'sub_element' => 'PENUNJANG TUGAS GURU',
              'activity_item' => 'Melaksanakan kegiatan yang mendukung tugas guru',
              'grain_item' => 'Melaksanakan kegiatan yang mendukung tugas guru;',
              'sub_grain_item' => 'Membimbing siswa dalam praktik kerja nyata / praktik industri / ekstrakurikuler dan sejenisnya',
              'code' => 67,
              'output' => 'Laporan',
              'credit_score' => 0.17,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Penunjang',
              'sub_element' => 'PENUNJANG TUGAS GURU',
              'activity_item' => 'Melaksanakan kegiatan yang mendukung tugas guru',
              'grain_item' => 'Melaksanakan kegiatan yang mendukung tugas guru;',
              'sub_grain_item' => 'Sebagai pengawas ujian penilaian dan evaluasi terhadap proses dan hasil belajar tingkat: Sekolah',
              'code' => 68,
              'output' => 'SK',
              'credit_score' => 0.08,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Penunjang',
              'sub_element' => 'PENUNJANG TUGAS GURU',
              'activity_item' => 'Melaksanakan kegiatan yang mendukung tugas guru',
              'grain_item' => 'Melaksanakan kegiatan yang mendukung tugas guru;',
              'sub_grain_item' => 'Sebagai pengawas ujian penilaian dan evaluasi terhadap proses dan hasil belajar tingkat: Nasional',
              'code' => 69,
              'output' => 'SK',
              'credit_score' => 0.08,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Penunjang',
              'sub_element' => 'PENUNJANG TUGAS GURU',
              'activity_item' => 'Melaksanakan kegiatan yang mendukung tugas guru',
              'grain_item' => 'Melaksanakan kegiatan yang mendukung tugas guru;',
              'sub_grain_item' => 'Menjadi anggota organisasi profesi, sebagai: Pengurus aktif',
              'code' => 70,
              'output' => 'SK',
              'credit_score' => 1.00,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Penunjang',
              'sub_element' => 'PENUNJANG TUGAS GURU',
              'activity_item' => 'Melaksanakan kegiatan yang mendukung tugas guru',
              'grain_item' => 'Melaksanakan kegiatan yang mendukung tugas guru;',
              'sub_grain_item' => 'Menjadi anggota organisasi profesi, sebagai: Anggota aktif',
              'code' => 71,
              'output' => 'Kartu Anggota',
              'credit_score' => 0.75,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Penunjang',
              'sub_element' => 'PENUNJANG TUGAS GURU',
              'activity_item' => 'Melaksanakan kegiatan yang mendukung tugas guru',
              'grain_item' => 'Melaksanakan kegiatan yang mendukung tugas guru;',
              'sub_grain_item' => 'Menjadi anggota kegiatan kepramukaan, sebagai: Pengurus aktif',
              'code' => 72,
              'output' => 'SK',
              'credit_score' => 1.00,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Penunjang',
              'sub_element' => 'PENUNJANG TUGAS GURU',
              'activity_item' => 'Melaksanakan kegiatan yang mendukung tugas guru',
              'grain_item' => 'Melaksanakan kegiatan yang mendukung tugas guru;',
              'sub_grain_item' => 'Menjadi anggota kegiatan kepramukaan, sebagai: Anggota aktif',
              'code' => 73,
              'output' => 'SK',
              'credit_score' => 0.75,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Penunjang',
              'sub_element' => 'PENUNJANG TUGAS GURU',
              'activity_item' => 'Melaksanakan kegiatan yang mendukung tugas guru',
              'grain_item' => 'Melaksanakan kegiatan yang mendukung tugas guru;',
              'sub_grain_item' => 'Menjadi tim penilai angka kredit',
              'code' => 74,
              'output' => '50 DUPAK',
              'credit_score' => 0.04,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Penunjang',
              'sub_element' => 'PENUNJANG TUGAS GURU',
              'activity_item' => 'Melaksanakan kegiatan yang mendukung tugas guru',
              'grain_item' => 'Melaksanakan kegiatan yang mendukung tugas guru;',
              'sub_grain_item' => 'Menjadi tutor/pelatih/instruktur',
              'code' => 75,
              'output' => '2 Jampel',
              'credit_score' => 0.04,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Penunjang',
              'sub_element' => 'PENUNJANG TUGAS GURU',
              'activity_item' => 'Perolehan penghargaan/tanda jasa Satya Lancana Karya Satya',
              'grain_item' => 'Melaksanakan kegiatan yang mendukung tugas guru;',
              'sub_grain_item' => '30 (tiga puluh) tahun',
              'code' => 76,
              'output' => 'Sertifikat / Piagam',
              'credit_score' => 3.00,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Penunjang',
              'sub_element' => 'PENUNJANG TUGAS GURU',
              'activity_item' => 'Perolehan penghargaan/tanda jasa Satya Lancana Karya Satya',
              'grain_item' => 'Melaksanakan kegiatan yang mendukung tugas guru;',
              'sub_grain_item' => '20 (dua puluh) tahun',
              'code' => 77,
              'output' => 'Sertifikat / Piagam',
              'credit_score' => 2.00,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Penunjang',
              'sub_element' => 'PENUNJANG TUGAS GURU',
              'activity_item' => 'Perolehan penghargaan/tanda jasa Satya Lancana Karya Satya',
              'grain_item' => 'Melaksanakan kegiatan yang mendukung tugas guru;',
              'sub_grain_item' => '10 (sepuluh) tahun',
              'code' => 78,
              'output' => 'Sertifikat / Piagam',
              'credit_score' => 1.00,
              'is_deleted' => FALSE
          ],
          [
              'element' => 'Unsur Penunjang',
              'sub_element' => 'PENUNJANG TUGAS GURU',
              'activity_item' => 'Perolehan penghargaan/tanda jasa Satya Lancana Karya Satya',
              'grain_item' => 'Memperoleh Penghargaan/tanda jasa;',
              'sub_grain_item' => null,
              'code' => 78,
              'output' => 'Sertifikat / Piagam',
              'credit_score' => 1.00,
              'is_deleted' => FALSE
          ]
      ]);
    }
}
