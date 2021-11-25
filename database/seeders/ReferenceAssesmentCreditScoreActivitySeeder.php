<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ReferenceAssesmentCreditScoreActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      \DB::table('reference_assesment_credit_score_activity')->insert([
          [
              'element' => 'Unsur Utama',
              'sub_element' => 'PENDIDIKAN',
              'activity_item' => 'Mengikuti pendidikan dan memperoleh gelar/ijazah/akta'
          ],
          [
              'element' => 'Unsur Utama',
              'sub_element' => 'PENDIDIKAN',
              'activity_item' => 'Mengikuti pelatihan prajabatan'
          ],
          [
              'element' => 'Unsur Utama',
              'sub_element' => 'PEMBELAJARAN/BIMBINGAN DAN TUGAS TERTENTU',
              'activity_item' => 'Melaksanakan proses pembelajaran'
          ],
          [
              'element' => 'Unsur Utama',
              'sub_element' => 'PEMBELAJARAN/BIMBINGAN DAN TUGAS TERTENTU',
              'activity_item' => 'Melaksanakan proses bimbingan'
          ],
          [
              'element' => 'Unsur Utama',
              'sub_element' => 'PEMBELAJARAN/BIMBINGAN DAN TUGAS TERTENTU',
              'activity_item' => 'Melaksanakan tugas lain yang relevan dengan fungsi sekolah'
          ],
          [
              'element' => 'Unsur Utama',
              'sub_element' => 'PENGEMBANGAN KEPROFESIAN BERKELANJUTAN',
              'activity_item' => 'Melaksanakan pengembangan diri'
          ],
          [
              'element' => 'Unsur Utama',
              'sub_element' => 'PENGEMBANGAN KEPROFESIAN BERKELANJUTAN',
              'activity_item' => 'Melaksanakan publikasi ilmiah'
          ],
          [
              'element' => 'Unsur Utama',
              'sub_element' => 'PENGEMBANGAN KEPROFESIAN BERKELANJUTAN',
              'activity_item' => 'Melaksanakan karya inovatif'
          ],
          [
              'element' => 'Unsur Penunjang',
              'sub_element' => 'PENUNJANG TUGAS GURU',
              'activity_item' => 'Memperoleh gelar/ijazah yang tidak sesuai dengan bidang yang diampuhnya'
          ],
          [
              'element' => 'Unsur Penunjang',
              'sub_element' => 'PENUNJANG TUGAS GURU',
              'activity_item' => 'Melaksanakan kegiatan yang mendukung tugas guru'
          ],
          [
              'element' => 'Unsur Penunjang',
              'sub_element' => 'PENUNJANG TUGAS GURU',
              'activity_item' => 'Perolehan penghargaan/tanda jasa Satya Lancana Karya Satya'
          ]
      ]);
    }
}
