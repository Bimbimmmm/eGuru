<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      DB::statement('CREATE EXTENSION IF NOT EXISTS "uuid-ossp";');
      Schema::create('users', function (Blueprint $table) {
          $table->uuid('id')->primary();
          $table->string('registration_number')->unique();
          $table->string('email')->unique();
          $table->string('password');
          $table->uuid('personal_data_id')->nullable();
          $table->foreign('personal_data_id')->references('id')->on('personal_datas');
          $table->uuid('role_id');
          $table->foreign('role_id')->references('id')->on('roles');
          $table->boolean('is_deleted');
          $table->rememberToken();
          $table->timestamps();
      });
      DB::statement('ALTER TABLE users ALTER COLUMN id SET DEFAULT uuid_generate_v4();');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
