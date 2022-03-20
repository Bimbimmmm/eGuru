<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalaryIncreaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      DB::statement('CREATE EXTENSION IF NOT EXISTS "uuid-ossp";');
      Schema::create('salary_increase', function (Blueprint $table) {
          $table->uuid('id')->primary();
          $table->string('year');
          $table->string('type');
          $table->uuid('user_id');
          $table->foreign('user_id')->references('id')->on('users');
          $table->string('old_salary');
          $table->date('old_decree_date');
          $table->string('old_decree_number');
          $table->date('old_date');
          $table->string('old_work_year');
          $table->string('new_salary')->nullable();
          $table->string('new_work_year')->nullable();
          $table->date('new_date')->nullable();
          $table->boolean('is_locked');
          $table->boolean('is_finish');
          $table->boolean('is_rejected');
          $table->string('rejected_reason')->nullable();
          $table->boolean('is_deleted');
          $table->timestamps();
      });
      DB::statement('ALTER TABLE salary_increase ALTER COLUMN id SET DEFAULT uuid_generate_v4();');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salary_increase');
    }
}
