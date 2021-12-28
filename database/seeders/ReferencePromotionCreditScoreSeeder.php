<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ReferencePromotionCreditScoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      \DB::table('reference_promotion_credit_score')->insert([
          [
              'current_rank' => 'IIIa',
              'promotion_rank' => 'IIIb',
              'cumulative_credit_score' => 150,
              'major_credit_score' => 42,
              'self_development_credit_score' => 3,
              'scientific_credit_score' => 0,
              'support_credit_score' => 5
          ],
          [
              'current_rank' => 'IIIb',
              'promotion_rank' => 'IIIc',
              'cumulative_credit_score' => 200,
              'major_credit_score' => 38,
              'self_development_credit_score' => 3,
              'scientific_credit_score' => 4,
              'support_credit_score' => 5
          ],
          [
              'current_rank' => 'IIIc',
              'promotion_rank' => 'IIId',
              'cumulative_credit_score' => 300,
              'major_credit_score' => 81,
              'self_development_credit_score' => 3,
              'scientific_credit_score' => 6,
              'support_credit_score' => 10
          ],
          [
              'current_rank' => 'IIId',
              'promotion_rank' => 'IVa',
              'cumulative_credit_score' => 400,
              'major_credit_score' => 78,
              'self_development_credit_score' => 4,
              'scientific_credit_score' => 8,
              'support_credit_score' => 10
          ],
          [
              'current_rank' => 'IVa',
              'promotion_rank' => 'IVb',
              'cumulative_credit_score' => 550,
              'major_credit_score' => 119,
              'self_development_credit_score' => 4,
              'scientific_credit_score' => 12,
              'support_credit_score' => 15
          ],
          [
              'current_rank' => 'IVb',
              'promotion_rank' => 'IVc',
              'cumulative_credit_score' => 700,
              'major_credit_score' => 119,
              'self_development_credit_score' => 4,
              'scientific_credit_score' => 12,
              'support_credit_score' => 15
          ],
          [
              'current_rank' => 'IVc',
              'promotion_rank' => 'IVd',
              'cumulative_credit_score' => 850,
              'major_credit_score' => 116,
              'self_development_credit_score' => 5,
              'scientific_credit_score' => 14,
              'support_credit_score' => 15
          ],
          [
              'current_rank' => 'IVd',
              'promotion_rank' => 'IVe',
              'cumulative_credit_score' => 1050,
              'major_credit_score' => 155,
              'self_development_credit_score' => 5,
              'scientific_credit_score' => 20,
              'support_credit_score' => 20
          ]
      ]);
    }
}
