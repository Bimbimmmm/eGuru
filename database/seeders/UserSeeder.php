<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      \DB::table('users')->insert([
          [
              'registration_number' => '1927182816336176773',
              'email' => 'admin@guru.tanatidungkab.go.id',
              'password' => Hash::make('namamuji'),
              'personal_data_id' => '2ea37923-c8d6-460d-8cc5-1ac1f5f8dc0a',
              'role_id' => '818ba4b5-83d1-4a93-b125-dd22e85678cb',
              'is_deleted' => FALSE,
              'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
              'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
          ]
      ]);
    }
}
