<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class WorkBehaviorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      \DB::table('reference_work_behavior')->insert([
          [
              'name' => 'Orientasi Pelayanan',
              'is_deleted' => FALSE
          ],
          [
              'name' => 'Integritas',
              'is_deleted' => FALSE
          ],
          [
              'name' => 'Komitmen',
              'is_deleted' => FALSE
          ],
          [
              'name' => 'Disiplin',
              'is_deleted' => FALSE,
          ],
          [
              'name' => 'Kerjasama',
              'is_deleted' => FALSE
          ],
          [
              'name' => 'Kepemimpinan',
              'is_deleted' => FALSE
          ]
      ]);
    }
}
