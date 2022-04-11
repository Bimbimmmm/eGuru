<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeacherDataFormalEducationHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE EXTENSION IF NOT EXISTS "uuid-ossp";');
        Schema::create('teacher_data_formal_education_history', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('education_level');
            $table->string('name');
            $table->date('start_date');
            $table->date('graduation_date');
            $table->string('place');
            $table->string('diploma_number');
            $table->string('file');
            $table->uuid('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->boolean('is_deleted');
            $table->timestamps();
        });
        DB::statement('ALTER TABLE teacher_data_formal_education_history ALTER COLUMN id SET DEFAULT uuid_generate_v4();');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teacher_data_formal_education_history');
    }
}
