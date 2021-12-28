<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ReferencePromotionFile extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      \DB::table('reference_promotion_file')->insert([
          [
              'name' => 'Surat Pengantar Instansi'
          ],
          [
              'name' => 'Surat Pernyataan Telah Melaksanakan Tugas Pembelajaran'
          ],
          [
              'name' => 'Surat Pernyataan Telah Melaksanakan Tugas Tertentu ( Lampiran II Peraturan Bersama )'
          ],
          [
              'name' => 'Surat Pernyataan Melakukan Pengembangan Keprofesian berkelanjutan ( PKB ) '
          ],
          [
              'name' => 'Surat Pernyataan Telah Melaksanakan Unsur Penunjang ( Lampiran IV )'
          ],
          [
              'name' => 'SK CPNS ( untuk kenaikan pangkat pertama )'
          ],
          [
              'name' => 'SK PNS'
          ],
          [
              'name' => 'SK Jabatan Fungsional'
          ],
          [
              'name' => 'SK Kenaikan Jabatan Fungsional ( Guru Pertama ke Guru Muda, dst ) '
          ],
          [
              'name' => 'SK Pengalihan PNSD dari Kab/Kota ke Provinsi oleh BKN'
          ],
          [
              'name' => 'SK Penempatan Tugas oleh Gubernur'
          ],
          [
              'name' => 'KARPEG / atau Konversi NIP'
          ],
          [
              'name' => 'Ijazah yang belum pernah diajukan penilaian angka kreditnya dilengkapi surat izin belajar'
          ],
          [
              'name' => 'SK Pembagian Tugas Mengajar'
          ],
          [
              'name' => 'Sertifikat Induksi bagi Guru Pemula'
          ],
          [
              'name' => 'Laporan PKG'
          ]
      ]);
    }
}
