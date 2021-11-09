<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      \DB::table('roles')->insert([
          [
              'name' => 'Administrator',
              'number' => 1
          ],
          [
              'name' => 'Guru',
              'number' => 2
          ],
          [
              'name' => 'Kepala Sekolah',
              'number' => 3
          ],
          [
              'name' => 'Kepala Bidang',
              'number' => 4
          ],
          [
              'name' => 'Kepala Dinas',
              'number' => 5
          ],
          [
              'name' => 'Penilai Angka Kredit',
              'number' => 6
          ],
          [
              'name' => 'Operator Sekolah',
              'number' => 7
          ],
          [
              'name' => 'Bupati',
              'number' => 8
          ]
      ]);
    }
}
