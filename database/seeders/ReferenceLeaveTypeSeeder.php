<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ReferenceLeaveTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      \DB::table('reference_leave_type')->insert([
          [
              'name' => 'Cuti Tahunan'
          ],
          [
              'name' => 'Cuti Besar'
          ],
          [
              'name' => 'Cuti Sakit'
          ],
          [
              'name' => 'Cuti Melahirkan'
          ],
          [
              'name' => 'Cuti Karena Alasan Penting'
          ]
        ]);
    }
}
