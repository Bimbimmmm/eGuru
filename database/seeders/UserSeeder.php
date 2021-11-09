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
              'email' => 'admin@guru.tanatidungkab.go.id',
              'password' => Hash::make('@dm1n3guru'),
              'personal_data_id' => '44d089d4-ea9f-4efa-aafd-4d5c7eec1e45',
              'role_id' => '818ba4b5-83d1-4a93-b125-dd22e85678cb',
              'is_deleted' => FALSE,
              'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
              'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
          ]
      ]);
    }
}
