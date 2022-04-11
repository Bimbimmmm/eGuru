<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeacherDataSalaryIncreaseHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE EXTENSION IF NOT EXISTS "uuid-ossp";');
        Schema::create('teacher_data_salary_increase_history', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('number_of_decree');
            $table->date('starting_from_date');
            $table->string('last_rank');
            $table->string('last_salary');
            $table->string('new_salary');
            $table->string('issued_by');
            $table->string('file');
            $table->uuid('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->boolean('is_deleted');
            $table->timestamps();
        });
        DB::statement('ALTER TABLE teacher_data_salary_increase_history ALTER COLUMN id SET DEFAULT uuid_generate_v4();');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teacher_data_salary_increase_history');
    }
}
