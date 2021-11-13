<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ReferenceWorkUnitsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      \DB::table('reference_work_units')->insert([
          [
              'name' => 'SDN 1 Tideng Pale',
              'address' => 'Jl. Poros KTT - Malinau',
              'province' => 'KALIMANTAN UTARA',
              'city' => 'KABUPATEN TANA TIDUNG',
              'district' => 'SESAYAP',
              'village' => 'TIDENG PALE',
              'zip_code' => '77152',
              'is_deleted' => FALSE,
              'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
              'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
          ]
      ]);
    }
}
