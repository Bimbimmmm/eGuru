<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ReferenceSalaryIncreaseFileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      \DB::table('reference_salary_increase_file')->insert([
          [
              'name' => 'SK CPNS/PNS (Untuk Pertama Kali)',
              'is_mutation' => FALSE
          ],
          [
              'name' => 'SK Kenaikan Pangkat Terakhir',
              'is_mutation' => FALSE
          ],
          [
              'name' => 'SK Kenaikan Gaji Berkala Terakhir',
              'is_mutation' => FALSE
          ],
          [
              'name' => 'DP3 2 (Dua) Tahun Terakhir',
              'is_mutation' => FALSE
          ],
          [
              'name' => 'Surat Pengantar Unit Kerja',
              'is_mutation' => FALSE
          ],
          [
              'name' => 'SK Mutasi',
              'is_mutation' => TRUE
          ],
          [
              'name' => 'SK Pemberhentian Pembayaran Gaji',
              'is_mutation' => TRUE
          ]
      ]);
    }
}
