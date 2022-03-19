<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalaryIncreaseFileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE EXTENSION IF NOT EXISTS "uuid-ossp";');
        Schema::create('salary_increase_file', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('salary_increase_id');
            $table->foreign('salary_increase_id')->references('id')->on('salary_increase');
            $table->integer('reference_salary_increase_file_id');
            $table->foreign('reference_salary_increase_file_id')->references('id')->on('reference_salary_increase_file');
            $table->string('file')->nullable();
            $table->timestamps();
        });
        DB::statement('ALTER TABLE salary_increase_file ALTER COLUMN id SET DEFAULT uuid_generate_v4();');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salary_increase_file');
    }
}
