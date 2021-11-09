<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PersonalDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      \DB::table('personal_datas')->insert([
          [
              'name' => 'Administrator',
              'registration_number' => '1234567890',
              'id_number' => '0987654321',
              'educator_number' => '7658493021',
              'birth_place' => 'Tidung Pale',
              'birth_date' => Carbon::now()->format('Y-m-d'),
              'gender' => 'Laki-laki',
              'marital_status_id' => '097eff05-e2c1-42c9-ba5e-1a6a380ab7e8',
              'religion_id' => '7be7e068-e60e-4195-b3be-8456eda92576',
              'rank_id' => 'a121c2c9-3306-4977-b2b1-28cb84c36b3a',
              'work_unit_id' => 'b54f3990-3beb-4fc3-9ab3-cfb6eda921a8',
              'position_id' => '33eb75b7-ef83-411d-b660-763dfac011b0',
              'status_id' => '31f984f4-670a-4cfb-87bf-8f8ffd6f2360',
              'education_id' => '6d89f893-160d-4f7d-8ea9-1177587da9c5',
              'cs_year' => Carbon::now()->format('Y-m-d'),
              'cs_candidate_year' => Carbon::now()->format('Y-m-d'),
              'tax_number' => Carbon::now()->format('Y-m-d'),
              'address' => 'Jl. Perintis RT. 07',
              'province' => 'KALIMANTAN UTARA',
              'city' => 'KABUPATEN TANA TIDUNG',
              'district' => 'SESAYAP',
              'village' => 'TIDENG PALE',
              'zip_code' => '77152',
              'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
              'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
          ]
      ]);
    }
}
