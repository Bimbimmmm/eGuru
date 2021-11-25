<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ReferenceEducationCreditScoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      \DB::table('reference_education_credit_score')->insert([
          [
              'name' => 'Doktoral(S3)',
              'is_adjustment' => FALSE,
              'credit_score' => 200.00
          ],
          [
              'name' => 'Penyesuaian Dari Magister(S2) Ke Doktoral (S3)',
              'is_adjustment' => TRUE,
              'credit_score' => 200.00
          ],
          [
              'name' => 'Magister (S2)',
              'is_adjustment' => FALSE,
              'credit_score' => 150.00
          ],
          [
              'name' => 'Penyesuaian Dari Sarjana (S1) Ke Magister(S2)',
              'is_adjustment' => TRUE,
              'credit_score' => 150.00
          ],
          [
              'name' => 'Sarjana (S1)',
              'is_adjustment' => FALSE,
              'credit_score' => 100.00
          ]
        ]);
    }
}
