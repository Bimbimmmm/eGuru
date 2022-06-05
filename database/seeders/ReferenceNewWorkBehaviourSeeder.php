<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ReferenceNewWorkBehaviourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      \DB::table('reference_new_work_behaviour')->insert([
          [
              'name' => 'Orientasi Pelayanan',
              'is_deleted' => FALSE,
              'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
              'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
          ],
          [
              'name' => 'Komitmen',
              'is_deleted' => FALSE,
              'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
              'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
          ],
          [
              'name' => 'Inisiatif Kerja',
              'is_deleted' => FALSE,
              'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
              'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
          ],
          [
              'name' => 'Kerjasama',
              'is_deleted' => FALSE,
              'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
              'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
          ],
          [
              'name' => 'Kepemimpinan',
              'is_deleted' => FALSE,
              'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
              'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
          ]
      ]);
    }
}
